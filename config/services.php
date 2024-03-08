<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'google' => [
        'client_id' => '706711540592-ntlkrefn4s7qqkuei46s81qqfb8doec0.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://1boxoffice.com/en/callback/google',
        //'redirect' => url('/en').'/callback/google',
    ], 

    'facebook' => [
        'client_id' => '1177767039650617', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'client_secret' => '54256cca6c5c2e18f467477004bb9693', //USE FROM FACEBOOK DEVELOPER ACCOUNT
        'redirect' => 'https://1boxoffice.com/en/callback/facebook',
        //'redirect' => url('/en').'/callback/facebook'
    ],

];
