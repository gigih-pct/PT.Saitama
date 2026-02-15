<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Cloudflare Turnstile Configuration
    |--------------------------------------------------------------------------
    |
    | Site Key: Digunakan di frontend untuk render widget
    | Secret Key: Digunakan di backend untuk validasi token
    |
    */

    'site_key' => env('TURNSTILE_SITE_KEY', ''),
    'secret_key' => env('TURNSTILE_SECRET_KEY', ''),
    'verify_url' => 'https://challenges.cloudflare.com/turnstile/v0/siteverify',
];
