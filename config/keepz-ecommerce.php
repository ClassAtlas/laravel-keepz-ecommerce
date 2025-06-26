<?php

return [
    'private_key' => storage_path((string) env('KEEPZ_ECOMMERCE_PRIVKEY', '')),
    'public_key' => storage_path((string) env('KEEPZ_ECOMMERCE_PUBKEY', '')),
    'api_url' => env('KEEPZ_ECOMMERCE_API_URL', 'https://gateway.keepz.me/ecommerce-service'),
    'integrator_id' => env('KEEPZ_ECOMMERCE_INTEGRATOR_ID', ''),
];
