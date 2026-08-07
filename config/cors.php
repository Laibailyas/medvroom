<?php

return [

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'broadcasting/auth', 'conversations/*', 'messages/*'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'https://medvroom.com',
        'https://www.medvroom.com',
    ],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];