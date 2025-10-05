<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Log};
// use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use App\Models\UnitPurchase;
use App\Models\MessageContact;
use Carbon\Carbon;

class SmsController extends Controller
{
     // A standard SMS is 160 characters (GSM 03.38), or 70 characters (Unicode).
    const GSM_CHARS_PER_UNIT = 160;
    const UNICODE_CHARS_PER_UNIT = 70;

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

        $recipients = explode(',', $request->input('to'));
        $messageContent = $request->input('content');
        $senderId = $request->input('from') ?? 'DEFAULT_ID'; // Use a default sender ID if none provided

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

        // 3. Unit Deduction (Transactional)
        if (!$this->deductUnits($user, $totalUnitsRequired)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to deduct units. Please try again.',
            ], 500);
        }

        // 4. Record Message in DB (messages table)
        $messageRecord = Message::create([
            'user_id' => $user->id,
            'type' => 'sms',
            'title' => 'API SMS: ' . Carbon::now()->toDateTimeString(),
            'content' => $messageContent,
            'status' => '1', // 1: Processing
            // The 'sent_at' field is an INT, assuming it tracks time/date in a specific format
            // We'll set it to 0 initially if not sent immediately, or current time if it is.
            // For an API, let's treat it as an immediate send request.
            'sent_at' => Carbon::now()->timestamp, // Store as Unix Timestamp (INT)
        ]);

        $contactMessageRecords = [];
        $messagesSentCount = 0;
        $failedRecipients = [];

        // 5. Dispatch SMS and Record Individual Status (contact_message table)
        foreach ($recipients as $number) {
            $number = trim($number);

            // --- YOUR EXISTING THIRD-PARTY API CALL GOES HERE ---
            // In a real application, you would call your integrated service here:
            // $response = $this->smsGateway->send($senderId, $number, $messageContent);
            // $gatewayRef = $response->getGatewayReference();
            // $isSuccess = $response->isSuccessful();
            $isSuccess = true; // Mock success for demonstration
            $gatewayRef = uniqid('ref_');
            // --- END THIRD-PARTY API CALL ---

            $status = $isSuccess ? '1' : '3'; // 1: Sent, 3: Failed (based on your enum in contact_message)

            $contactMessageRecords[] = MessageContact::create([
                'contact_id' => 0, // No specific contact ID for API sends, can be 0 or null
                'message_id' => $messageRecord->id,
                'status' => $status,
                'gateway_ref' => $gatewayRef,
                'sent' => $isSuccess ? $number : null,
                'failed' => !$isSuccess ? $number : null,
            ]);

            if ($isSuccess) {
                $messagesSentCount++;
            } else {
                $failedRecipients[] = $number;
            }
        }

        // 6. Final Response
        return response()->json([
            'status' => 'success',
            'message' => 'SMS request processed.',
            'total_recipients' => count($recipients),
            'units_deducted' => $totalUnitsRequired,
            'messages_sent' => $messagesSentCount,
            'failed_recipients' => $failedRecipients,
            'new_balance' => $user->fresh()->available_units, // Fetch fresh balance
            'request_id' => $messageRecord->id,
        ], 200);
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
