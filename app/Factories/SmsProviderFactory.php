<?php

namespace App\Factories;

use App\Interfaces\SmsProviderInterface;
use App\Utils\EbulkSms;
use App\Utils\SmartHiveSms;
use Illuminate\Support\Facades\Log;

class SmsProviderFactory
{
    /**
     * Determine which SMS provider is currently active and return its instance.
     *
     * @return SmsProviderInterface
     */
    public function getActiveProvider(): SmsProviderInterface
    {
        // Option A: Get the active provider from your database (e.g., a Settings table)
        // $activeGateway = \App\Models\Setting::where('key', 'active_sms_gateway')->value('value');

        // Option B: Get the active provider from your .env / config files (used in this example)
        $activeGateway = config('services.sms.active_gateway', 'ebulk');

        // Match the string to the actual class implementation
        return match ($activeGateway) {
            'smarthive' => app(SmartHiveSms::class),
            'ebulk'  => app(EbulkSms::class),
            default  => $this->resolveDefault(),
        };
    }

    /**
     * Fallback mechanism in case the configured provider is missing or invalid.
     */
    private function resolveDefault(): SmsProviderInterface
    {
        Log::warning("Invalid or missing active SMS gateway configuration. Falling back to default (SmartHiveSms).");
        return app(SmartHiveSms::class);
    }
}