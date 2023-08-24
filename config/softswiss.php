<?php

return [
    'enabled' => env('SOFTSWISS_ENABLED', false),
    'gcp_url' => env('SOFTSWISS_GCP_URL', 'https://casino.int.a8r.games'),
    'auth_token' => env('SOFTSWISS_AUTH_TOKEN'),
    'casino_id' => env('SOFTSWISS_CASINO_ID'),
    'path' => env('SOFTSWISS_PATH', 'softswiss'),
    'excluded_providers' => env('SOFTSWISS_EXCLUDED_PROVIDERS', []),
    'middleware' => [
        'web',
    ],
    'providers' => [
        'game' => [
            'table_name' => 'games',
            'connection' => env('DB_CONNECTION', 'mysql'),
            'model' => \Pow10s\Softswiss\Models\Game::class,
        ],
        'provider' => [
            'table_name' => 'providers',
            'connection' => env('DB_CONNECTION', 'mysql'),
            'model' => \Pow10s\Softswiss\Models\Provider::class,
        ],
        'category' => [
            'table_name' => 'categories',
            'connection' => env('DB_CONNECTION', 'mysql'),
            'model' => \Pow10s\Softswiss\Models\Category::class,
        ],
    ],
];
