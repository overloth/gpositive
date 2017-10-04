<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
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
    ],

    'google' => [
        'client_id' => '57182562399-4up23bv4k5bdtv5ld6g1hol6pam0cb3b.apps.googleusercontent.com',
        'client_secret' => 'yB6W0cYr0QUsYK_DcGWSQ8h7',
        'redirect' => 'http://gpositive.app/auth/google/callback',
    ],

    'facebook' => [
    'client_id' => '122590138393703',
    'client_secret' => 'b2a188ae62ef9aca07dea9a01f6d4086',
    'redirect' => 'https://gpositive.herokuapp.com/callback',
    
    ],

];
