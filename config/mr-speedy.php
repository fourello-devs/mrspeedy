<?php

return [
    'api' => [
        'token' => env('MR_SPEEDY_API_TOKEN')
    ],
    'callback' => [
        'token' => env('MR_SPEEDY_CALLBACK_TOKEN'),
        'url' => env('MR_SPEEDY_CALLBACK_URL')
    ],
    'environment' => env('MR_SPEEDY_ENVIRONMENT')
];
