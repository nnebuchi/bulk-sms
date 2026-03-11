<?php

namespace App\Interfaces;

interface SmsProviderInterface
{
    /**
     * Send a batch of SMS messages.
     *
     * @param array $recipients Array of phone numbers.
     * @param string $message The message content.
     * @param string $senderId The sender ID (e.g., 'Skezzole').
     * @return array Must return an array with 'success' (bool), 'gateway_response' (string), and 'gateway_ref' (string|null).
     */
    public function sendBatch(array $recipients, string $message, string $senderId): array;
}