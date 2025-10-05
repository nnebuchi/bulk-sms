<?php

return [
    'base_url'      => env('MTN_BASE_URL', 'https://api.mtn.com'),
    'sms_base_path' => env('MTN_SMS_BASE_PATH', '/v3/sms'),
    'token_url'     => env('MTN_TOKEN_URL'),
    'client_id'     => env('MTN_CLIENT_ID'),
    'client_secret' => env('MTN_CLIENT_SECRET'),
    'default_service_code' => env('MTN_DEFAULT_SERVICE_CODE', '131'),
    'request_dr'    => filter_var(env('MTN_REQUEST_DR', false), FILTER_VALIDATE_BOOLEAN),
    'timeout'       => (int) env('MTN_TIMEOUT', 20),
];
