<?php

namespace App\Factories;

use App\Interfaces\SmsProviderInterface;
use App\Utils\EbulkSms;
use App\Utils\SmartHiveSms;
use Illuminate\Support\Facades\Log;

class SmsProviderFactory
{
    public function getActiveProvider(): SmsProviderInterface
    {
        // Get the active provider from your config or DB
        $activeGateway = config('services.sms.active_gateway', 'smarthive');

        // Replaced PHP 8 'match' with PHP 7 'switch'
        switch ($activeGateway) {
            case 'smarthive':
                return app(SmartHiveSms::class);
            case 'ebulk':
                return app(EbulkSms::class);
            default:
                return $this->resolveDefault();
        }
    }

    private function resolveDefault(): SmsProviderInterface
    {
        Log::warning("Invalid or missing active SMS gateway configuration. Falling back to default.");
        return app(SmartHiveSms::class); 
    }
}