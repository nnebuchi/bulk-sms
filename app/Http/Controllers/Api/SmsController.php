<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Log};
use Illuminate\Support\Facades\Validator;
use App\Models\Message;
use App\Models\UnitPurchase;
use App\Models\MessageContact;
use App\Factories\SmsProviderFactory; // <-- Added Factory
use Carbon\Carbon;
use Illuminate\Support\Str;

class SmsController extends Controller
{
    // A standard SMS is 160 characters (GSM 03.38), or 70 characters (Unicode).
    const GSM_CHARS_PER_UNIT = 160;
    const UNICODE_CHARS_PER_UNIT = 70;

    protected $smsFactory;

    /**
     * Inject the SmsProviderFactory to resolve the active gateway.
     */
    public function __construct(SmsProviderFactory $smsFactory) 
    {
        $this->smsFactory = $smsFactory;
    }

    /**
     * Calculates the number of units required for a given message content.
     *
     * @param string $content
     * @return int The number of SMS segments/units required.
     */
    protected function calculateUnits(string $content): int
    {
        if (preg_match('/[^\x20-\x7E\r\n\t]/', $content)) {
            return ceil(mb_strlen($content, 'UTF-8') / self::UNICODE_CHARS_PER_UNIT);
        } else {
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
        $unitRecords = $user->units()
            ->where('available_units', '>', 0)
            ->orderBy('created_at', 'asc')
            ->get();

        if ($user->available_units < $unitsNeeded) {
            return false;
        }

        $remainingToDeduct = $unitsNeeded;

        DB::beginTransaction();
        try {
            foreach ($unitRecords as $unitRecord) {
                if ($remainingToDeduct <= 0) break;

                $available = (float) $unitRecord->available_units;

                if ($available >= $remainingToDeduct) {
                    $unitRecord->available_units = $available - $remainingToDeduct;
                    $unitRecord->save();
                    $remainingToDeduct = 0;
                } else {
                    $remainingToDeduct -= $available;
                    $unitRecord->available_units = 0;
                    $unitRecord->save();
                }
            }

            if ($remainingToDeduct > 0) {
                DB::rollBack();
                return false;
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
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
            'to' => 'required|string|regex:/^(\+?\d{7,15},?)+$/', 
            'from' => 'nullable|string|max:11',
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
            ->map(function ($number) {
                return trim($number);
            })
            ->filter(function ($number) {
                return !empty($number);
            })
            ->unique()
            ->values()
            ->toArray();
        
        if (empty($recipients)) {
            return response()->json(['status' => 'error', 'message' => 'No valid recipients provided.'], 400);
        }

        $messageContent = $request->input('content');
        $senderId = $request->input('from') ?? 'Skezzole';

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

        // --- START BATCH SEND LOGIC ---
        $httpFailed = false;
        $gatewayRef = null;
        $errorMessage = ''; 

        DB::beginTransaction();

        try {
            // 4. Record Message in DB 
            $messageRecord = Message::create([
                'user_id' => $user->id,
                'type' => 'sms',
                'title' => 'API SMS: ' . Carbon::now()->toDateTimeString(),
                'content' => $messageContent,
                'status' => '0', 
                'sent_at' => Carbon::now()->timestamp, 
                'slug'=>Str::random(30),
            ]);

            // --- 5. Resolve Active Provider & Dispatch ---
            // The factory determines which provider is active (e.g., Ebulk, Twilio)
            $activeSmsService = $this->smsFactory->getActiveProvider();
            
            // Send using the uniform interface method
            $gatewayResponse = $activeSmsService->sendBatch($recipients, $messageContent, $senderId);
            
            // --- 6. Handle Gateway Response & Logging ---
            if ($gatewayResponse['success']) {
                Log::info('Message '.$messageRecord->id.' sent successfully via ' . get_class($activeSmsService) . '. Gateway Response: ' . $gatewayResponse['gateway_response']);
                $gatewayRef = $gatewayResponse['gateway_ref'];
                $messagesSentCount = count($recipients);
                
                $contactMessageRecords = [];
                $now = Carbon::now();
                foreach ($recipients as $number) {
                    $contactMessageRecords[] = [
                        'contact_id' => 0,
                        'message_id' => $messageRecord->id,
                        'status' => '0', 
                        'gateway_ref' => $gatewayRef,
                        'sent' => $number,
                        'failed' => null,
                        'created_at' => $now,
                        'updated_at' => $now,
                    ];
                }

                MessageContact::insert($contactMessageRecords);
                $messageRecord->update(['status' => '1']); 
                
                DB::commit();

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
                $httpFailed = true;
                $errorMessage = $gatewayResponse['message'];
                Log::error("SMS batch failed for user {$user->id} using " . get_class($activeSmsService) . ". Error: {$errorMessage}");
            }

        } catch (\Exception $e) {
            $httpFailed = true;
            $errorMessage = 'An unexpected error occurred during gateway communication: ' . $e->getMessage();
            Log::error("SMS Gateway Exception for user {$user->id}: " . $e->getMessage(), ['exception' => $e]);
        }

        // --- ERROR HANDLING (Gateway Failure) ---
        if ($httpFailed) {
            DB::rollBack(); 
            
            Log::critical("BATCH FAILED AFTER UNIT DEDUCTION. MANUAL REFUND REQUIRED FOR USER {$user->id}. Units: {$totalUnitsRequired}. Reason: {$errorMessage}");

            return response()->json([
                'status' => 'error',
                'message' => $errorMessage . ' Units were deducted but the batch failed. An administrator has been notified to investigate and process a manual refund if applicable.',
                'gateway_error' => true,
                'units_deducted' => $totalUnitsRequired,
                'new_balance' => $user->fresh()->available_units, 
            ], 502);
        }
    }

    // ... (balance and status methods remain exactly the same) ...
}