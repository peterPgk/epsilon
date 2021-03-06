<?php

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
|
| Needed credentials for obtain needed tokens
|
*/

return [
    'client_id' => env('SERVICES_API_CLIENT_ID'),
    'client_secret' => env('SERVICES_API_CLIENT_SECRET'),
    'authentication_url' => env('SERVICES_API_AUTHENTICATE_URL'),
    'refresh_url' => env('SERVICES_API_REFRESH_URL'),
    'authentication_type' => env('SERVICES_API_AUTHENTICATION_TYPE', 'password'),
    'url' => [
        'services' => env('SERVICES_API_INDEX')
    ]
];
