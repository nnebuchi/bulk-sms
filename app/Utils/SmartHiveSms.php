<?php

namespace App\Utils;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Interfaces\SmsProviderInterface;

/**
 * Handles communication with the SmartHive SMS API.
 */
class SmartHiveSms implements SmsProviderInterface
{
    protected $baseUrl;
    protected $apiKey;
    protected $defaultSender;

    public function __construct()
    {
        // Load configurations from environment file
        $this->baseUrl = env('SMARTHIVE_SMS_BASE_URL', 'https://api.smarthivesms.com/api/sms/send');
        $this->apiKey = env('SMARTHIVE_SMS_API_KEY');
        $this->defaultSender = env('SMARTHIVE_SMS_DEFAULT_SENDER', 'Skezzole');
    }

    /**
     * Sends a batch SMS request to the SmartHive SMS gateway.
     *
     * @param array $recipients Array of phone numbers.
     * @param string $message The message content.
     * @param string $senderId The sender ID to use.
     * @return array Returns ['success' => bool, 'message' => string, 'gateway_response' => string, 'gateway_ref' => string|null]
     */
    public function sendBatch(array $recipients, string $message, string $senderId): array
    {
        // Ensure sender ID is set, fallback to default if empty
        $finalSenderId = empty($senderId) ? $this->defaultSender : $senderId;
        
        // SmartHive expects recipients as a string (assuming comma-separated for multiple)
        $recipientsString = implode(',', $recipients);
        
        // Generate a unique external reference for the transaction
        $extRef = Str::uuid()->toString();

        $payload = [
            'sender' => $finalSenderId,
            'recipients' => $recipientsString,
            'msg' => $message,
            'type' => 1,
            'route' => 'TRX',
            'ext_ref' => $extRef
        ];

        // Critical Check: Ensure API key is configured
        if (!$this->apiKey) {
            return [
                'success' => false,
                'message' => 'SmartHive SMS credentials are not configured in the environment.',
                'gateway_response' => 'Missing Credentials',
                'gateway_ref' => null,
            ];
        }

        try {
            // Make a POST request with the required x-api-key header
            $response = Http::timeout(30)
                ->withHeaders([
                    'x-api-key' => $this->apiKey,
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json'
                ])
                ->post($this->baseUrl, $payload);
            
            $responseData = $response->json();
            $responseBody = $response->body(); // Keep raw body for exact logging

            // Check if the API returned a successful status
            if ($response->successful() && isset($responseData['status']) && strtolower($responseData['status']) === 'ok') {
                return [
                    'success' => true,
                    'message' => $responseData['description'] ?? 'Batch submitted successfully',
                    'gateway_ref' => $responseData['data']['msg_id'] ?? $extRef, // Use SmartHive's msg_id if available, fallback to our ext_ref
                    'gateway_response' => $responseBody
                ];
            }
            
            // Gateway rejected the request (e.g., bad auth, insufficient funds)
            return [
                'success' => false,
                'message' => "SmartHive SMS Error: " . ($responseData['description'] ?? 'Unknown error'),
                'gateway_ref' => null,
                'gateway_response' => $responseBody
            ];

        } catch (\Exception $e) {
            Log::error('SmartHive SMS connection error: ' . $e->getMessage(), ['exception' => $e]);
            return [
                'success' => false,
                'message' => 'Failed to connect to SmartHive SMS gateway.',
                'gateway_ref' => null,
                'gateway_response' => $e->getMessage()
            ];
        }
    }
}