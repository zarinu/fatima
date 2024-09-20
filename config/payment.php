<?php

use Illuminate\Support\Facades\Facade;

return [

    /*
    |--------------------------------------------------------------------------
    | ZarinPal Api Urls
    |--------------------------------------------------------------------------
    |
    | Specify the sandbox and normal type of zarinpal gateway
    |
    */

    'zarinpal' => [
        'normal' => [
            'request_url' => 'https://api.zarinpal.com/pg/v4/payment/request.json',
            'verify_url' => 'https://api.zarinpal.com/pg/v4/payment/verify.json',
            'start_pay_url' => 'https://www.zarinpal.com/pg/StartPay/',
        ],
        'sandbox' => [
            'request_url' => 'https://sandbox.zarinpal.com/pg/v4/payment/request.json',
            'verify_url' => 'https://sandbox.zarinpal.com/pg/v4/payment/verify.json',
            'start_pay_url' => 'https://sandbox.zarinpal.com/pg/StartPay/',
        ],
        'status' => env('ZARINPAL_STATUS', 'normal'),
        'merchant_id' => env('ZARINPAL_MERCHANT_ID'),
    ],
];
