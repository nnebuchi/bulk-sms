<?php

namespace App\Utils;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Handles communication with the Ebulk SMS API.
 */
class EbulkSms
{
    protected $baseUrl;
    protected $username;
    protected $apiKey;
    protected $defaultSender;

    public function __construct()
    {
        // Load configurations from environment file (ensure these keys are in your .env)
        $this->baseUrl = env('EBULK_SMS_BASE_URL');
        $this->username = env('EBULK_SMS_USERNAME');
        $this->apiKey = env('EBULK_SMS_API_KEY');
        $this->defaultSender = env('EBULK_SMS_DEFAULT_SENDER', 'AppSMS');
    }

    /**
     * Sends a batch SMS request to the Ebulk SMS gateway using a GET request.
     *
     * @param array $recipients Array of phone numbers.
     * @param string $message The message content.
     * @param string|null $sender The sender ID to use (falls back to default if null).
     * @return array Returns ['success' => bool, 'message' => string, 'gateway_ref' => string|null]
     */
    public function sendBatch(array $recipients, string $message, ?string $sender = null): array
    {
        $senderId = substr($sender ?? $this->defaultSender, 0, 11);
        
        // Ebulk SMS uses GET request with parameters in the query string
        $params = [
            'username' => $this->username,
            'apikey' => $this->apiKey,
            'sender' => $senderId,
            'messagetext' => $message,
            'flash' => 0,
            // Recipients must be a comma-separated string, as per the Node.js sample
            'recipients' => implode(',', $recipients), 
        ];

        // Critical: Check for credentials before hitting the API
        if (!$this->username || !$this->apiKey) {
             return [
                'success' => false,
                'message' => 'Ebulk SMS credentials are not configured in the environment.',
                'gateway_ref' => null,
            ];
        }

        try {
            // Make a GET request (as per the provided Node.js example)
            $response = Http::timeout(30)->get("{$this->baseUrl}/sendsms", $params);
           

            // Ebulk often returns a status code and message separated by a pipe (|) in the body
            $responseBody = trim($response->body());
            $responseArray = explode('|', $responseBody);
            if($responseArray[0] == 'SUCCESS'){
                 // Failure codes
                return [
                    'success' => true,
                    'gateway_ref' => "EBULK-" . time(),
                    'gateway_response' => $responseBody
                ];
            }
            

            // Parse the response string (e.g., "1701|Successfully sent" or "200|Invalid username")
            // $parts = explode('|', $responseBody, 2);
            // $statusCode = (int) $parts[0];
            // $statusMessage = $parts[1] ?? 'Unknown gateway error.';

            // Ebulk Success Codes: 1701 (Success), 1702 (DND check), 1703, 1704
            // if ($statusCode >= 1701 && $statusCode <= 1704) {
            //      return [
            //         'success' => true,
            //         'message' => "Batch submitted: " . $statusMessage,
            //         'gateway_ref' => "EBULK-" . time(), 
            //     ];
            // }

            // Failure codes
            // return [
            //     'success' => false,
            //     'message' => "Ebulk SMS Error [{$statusCode}]: " . $statusMessage,
            //     'gateway_ref' => null,
            //     'gateway_status_code' => $statusCode,
            // ];

        } catch (\Exception $e) {
            Log::error('Ebulk SMS connection error: ' . $e->getMessage(), ['exception' => $e]);
            return [
                'success' => false,
                'message' => 'Failed to connect to Ebulk SMS gateway.',
                'gateway_ref' => null,
            ];
        }
    }
}
