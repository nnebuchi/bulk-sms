<?php
namespace App\Services;
use App\Models\Message;
use App\Models\MessageContact;
use App\Models\MessageSchedule;
use App\Custom\SendMessage;

class SmsService {
    public static function sendSms (string $client_id, string $client_secret, string $message, array $phone_numbers) {
        $message = SendMessage::send($client_id, $client_secret, $message, $phone_numbers);
    }
}