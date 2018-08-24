<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ]
//      'facebook' => [
//        'client_id' =>  '1754937614829145',//'1754937614829145',
//        'client_secret' => 'cb555e307ac4658e9aa9343edbadb07a',//'cb555e307ac4658e9aa9343edbadb07a',
//        'redirect' => Url('social-login-callback')
//    ],
//    'google' => [
//        'client_id' =>  '441330879660-nhq60qlqpqnsl78bgj9k98q3budku4f0.apps.googleusercontent.com',
//        'client_secret' => 'ZX8G4UxW-gGSd_xTZhm4aaHm',
//        'redirect' => Url('social-login-callback'),
//    ]


];
