<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Log};
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use App\Models\UnitPurchase;
use App\Models\MessageContact;
use App\Utils\EbulkSms;
use Carbon\Carbon;
use Illuminate\Support\Str;

class SmsController extends Controller
{
    // A standard SMS is 160 characters (GSM 03.38), or 70 characters (Unicode).
    const GSM_CHARS_PER_UNIT = 160;
    const UNICODE_CHARS_PER_UNIT = 70;

    protected $smsService;

    /**
     * Inject the EbulkSms for gateway communication.
     */
    public function __construct(EbulkSms $smsService) 
    {
        $this->smsService = $smsService;
    }

    /**
     * Calculates the number of units required for a given message content.
     *
     * @param string $content
     * @return int The number of SMS segments/units required.
     */
    protected function calculateUnits(string $content): int
    {
        // Simple logic: check for unicode characters to determine segment size
        if (preg_match('/[^\x20-\x7E\r\n\t]/', $content)) {
            // Unicode message (e.g., non-Latin characters)
            return ceil(mb_strlen($content, 'UTF-8') / self::UNICODE_CHARS_PER_UNIT);
        } else {
            // Standard GSM message
            return ceil(strlen($content) / self::GSM_CHARS_PER_UNIT);
        }
    }

    /**
     * Deducts the required units from the user's UnitPurchase records.
     *
     * @param \App\Models\User $user
     * @param int $unitsNeeded
     * @return bool True on successful deduction, false otherwise.
     */
    protected function deductUnits(\App\Models\User $user, int $unitsNeeded): bool
    {
        // Get all available unit records for the user, ordered by creation date (FIFO)
        $unitRecords = $user->units()
            ->where('available_units', '>', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($user->available_units < $unitsNeeded) {
            return false; // Insufficient units (should be caught by the caller, but good safety check)
        }

        $remainingToDeduct = $unitsNeeded;

        // Use a transaction for safety during deduction
        DB::beginTransaction();
        try {
            foreach ($unitRecords as $unitRecord) {
                if ($remainingToDeduct <= 0) break;

                $available = (float) $unitRecord->available_units;

                if ($available >= $remainingToDeduct) {
                    // This record covers the rest of the deduction
                    $unitRecord->available_units = $available - $remainingToDeduct;
                    $unitRecord->save();
                    $remainingToDeduct = 0;
                } else {
                    // Deduct all units from this record and move to the next
                    $remainingToDeduct -= $available;
                    $unitRecord->available_units = 0;
                    $unitRecord->save();
                }
            }

            if ($remainingToDeduct > 0) {
                // Should not happen if initial check passes, but rollback if deduction failed
                DB::rollBack();
                return false;
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            // Log the error
            Log::error("Unit deduction failed for user {$user->id}: " . $e->getMessage());
            return false;
        }
    }


    /**
     * Send an SMS message via the API.
     * POST /api/sms/send
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function send(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Validation
        $validator = Validator::make($request->all(), [
            'to' => 'required|string|regex:/^(\+?\d{7,15},?)+$/', // Comma separated phone numbers
            'from' => 'nullable|string|max:11', // Sender ID
            'content' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $recipients = collect(explode(',', $request->input('to')))
            ->map(fn($number) => trim($number))
            ->filter(fn($number) => !empty($number))
            ->unique()
            ->values()
            ->toArray();
        
        if (empty($recipients)) {
            return response()->json(['status' => 'error', 'message' => 'No valid recipients provided.'], 400);
        }

        $messageContent = $request->input('content');
        $senderId = $request->input('from') ?? 'Skezzole'; // Use a default sender ID if none provided

        $unitsPerSms = $this->calculateUnits($messageContent);
        $totalUnitsRequired = $unitsPerSms * count($recipients);

        // 2. Unit Check
        if ($user->available_units < $totalUnitsRequired) {
            return response()->json([
                'status' => 'error',
                'message' => 'Insufficient SMS units.',
                'available_units' => $user->available_units,
                'required_units' => $totalUnitsRequired,
            ], 403);
        }

        // 3. Unit Deduction (Transactional) - **Happens before gateway call**
        if (!$this->deductUnits($user, $totalUnitsRequired)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to deduct units. Please try again.',
            ], 500);
        }

        // --- START BATCH SEND LOGIC ---
        $httpFailed = false;
        $gatewayRef = null;
        $errorMessage = ''; // Variable to hold specific error message for response

        // Use a DB transaction to ensure Message and MessageContact records are only created 
        // if the external gateway accepts the batch.
        DB::beginTransaction();

        try {
            // 4. Record Message in DB (messages table) - Status 0: Processing
            $messageRecord = Message::create([
                'user_id' => $user->id,
                'type' => 'sms',
                'title' => 'API SMS: ' . Carbon::now()->toDateTimeString(),
                'content' => $messageContent,
                'status' => '0', 
                'sent_at' => Carbon::now()->timestamp, 
                'slug'=>Str::random(30),
            ]);

            // --- 5. Batch Dispatch SMS via Third-Party API (EbulkSms) ---
            // Use the injected service to handle the Ebulk API call
            $gatewayResponse = $this->smsService->sendBatch($recipients, $messageContent, $senderId);
            
            // --- 6. Handle Gateway Response & Logging ---
            
            if ($gatewayResponse['success']) {
                Log::info('Message '.$messageRecord->id.'sent successfully. Gateway Response: ' . $gatewayResponse['gateway_response']);
                $gatewayRef = $gatewayResponse['gateway_ref'];
                $messagesSentCount = count($recipients);
                
                // --- 6.1. Record Individual Status (MessageContact table) via Bulk Insert ---
                $contactMessageRecords = [];
                $now = Carbon::now();
                foreach ($recipients as $number) {
                    $contactMessageRecords[] = [
                        'contact_id' => 0,
                        'message_id' => $messageRecord->id,
                        'status' => '0', // 0: Pending/Submitted (waiting for DLR)
                        'gateway_ref' => $gatewayRef,
                        'sent' => $number,
                        'failed' => null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                // Bulk insert the message contact records for efficiency
                MessageContact::insert($contactMessageRecords);

                // Update the parent message status to '1': Sent/Submitted
                $messageRecord->update(['status' => '1']); 
                
                DB::commit();

                // 7. Final Success Response
                return response()->json([
                    'status' => 'success',
                    'message' => 'SMS request processed and submitted to gateway in batch.',
                    'total_recipients' => count($recipients),
                    'units_deducted' => $totalUnitsRequired,
                    'messages_sent' => $messagesSentCount,
                    'failed_recipients' => [],
                    'new_balance' => $user->fresh()->available_units,
                    'request_id' => $messageRecord->id,
                    'gateway_batch_id' => $gatewayRef,
                ], 200);

            } else {
                // Gateway service returned failure (API key issue, quota, bad request, etc.)
                $httpFailed = true;
                $errorMessage = $gatewayResponse['message'];
                Log::error("Ebulk SMS batch failed for user {$user->id}. Error: {$errorMessage}");
            }

        } catch (\Exception $e) {
            $httpFailed = true;
            $errorMessage = 'An unexpected error occurred during gateway communication: ' . $e->getMessage();
            Log::error("SMS Gateway Exception for user {$user->id}: " . $e->getMessage(), ['exception' => $e]);
        }

        // --- ERROR HANDLING (Gateway Failure) ---
        if ($httpFailed) {
            DB::rollBack(); // Rollback Message and MessageContact creation
            
            // LOG CRITICAL ALERT for manual refund (NO AUTOMATIC REFUND)
            Log::critical("BATCH FAILED AFTER UNIT DEDUCTION. MANUAL REFUND REQUIRED FOR USER {$user->id}. Units: {$totalUnitsRequired}. Reason: {$errorMessage}");

            return response()->json([
                'status' => 'error',
                'message' => $errorMessage . ' Units were deducted but the batch failed. An administrator has been notified to investigate and process a manual refund if applicable.',
                'gateway_error' => true,
                'units_deducted' => $totalUnitsRequired,
                'new_balance' => $user->fresh()->available_units, // Show user their deducted balance
            ], 502);
        }
    }

    /**
     * Get the user's available SMS balance.
     * GET /api/user/balance
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function balance(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'message' => 'Current SMS unit balance.',
            'available_units' => $user->available_units,
        ], 200);
    }

    /**
     * Get the delivery status of a specific message request.
     * GET /api/sms/status/{message}
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Message $message The Message instance injected by Route-Model binding.
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request, Message $message)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 1. Authorization Check: Ensure the user owns this message record.
        if ($message->user_id !== $user->id) {
            return response()->json([
                'status' => 'error',
                'message' => 'Forbidden: You do not have permission to view this message.'
            ], 403);
        }

        // 2. Fetch related delivery records
        $deliveryReports = MessageContact::where('message_id', $message->id)->get();

        // 3. Helper to map status codes to human-readable strings
        $statusMap = [
            '0' => 'Pending',
            '1' => 'Sent',
            '2' => 'Delivered', // Assuming '2' means delivered
            '3' => 'Failed'
        ];

        // 4. Format the recipient data
        $recipientsData = $deliveryReports->map(function ($report) use ($statusMap) {
            $number = $report->status == '3' ? $report->failed : $report->sent;
            return [
                'number' => $number,
                'status' => $statusMap[$report->status] ?? 'Unknown',
                'gateway_ref' => $report->gateway_ref,
            ];
        });

        // 5. Create a summary
        $summary = [
            'total_recipients' => $deliveryReports->count(),
            'sent' => $deliveryReports->whereIn('status', ['1', '2'])->count(),
            'delivered' => $deliveryReports->where('status', '2')->count(),
            'failed' => $deliveryReports->where('status', '3')->count(),
        ];

        // 6. Return the final response
        return response()->json([
            'status' => 'success',
            'message' => 'Message status retrieved.',
            'request_id' => $message->id,
            'submitted_at' => Carbon::createFromTimestamp($message->sent_at)->toIso8601String(),
            'content' => $message->content,
            'summary' => $summary,
            'recipients' => $recipientsData,
        ], 200);
    }
}
