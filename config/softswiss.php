<?php

return [
    'gcp_url' => env('SOFTSWISS_GCP_URL', 'https://casino.int.a8r.games'),
    'auth_token' => env('SOFTSWISS_AUTH_TOKEN'),
    'casino_id' => env('SOFTSWISS_CASINO_ID'),
    'wallet_uri' => env('SOFTSWISS_WALLET_URI', 'webhook/softswiss'),
];
