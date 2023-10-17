<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;


class PaymentsController extends Controller
{
    public function firstStep() {

//
//        $curl = curl_init();
//
//        curl_setopt_array($curl, array(
//            CURLOPT_URL => 'https://api.zarinpal.com/pg/v4/payment/request.json',
//            CURLOPT_RETURNTRANSFER => true,
//            CURLOPT_ENCODING => '',
//            CURLOPT_MAXREDIRS => 10,
//            CURLOPT_TIMEOUT => 0,
//            CURLOPT_FOLLOWLOCATION => true,
//            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//            CURLOPT_CUSTOMREQUEST => 'POST',
//            CURLOPT_POSTFIELDS =>'{
//  "merchant_id": "25c38aed-b2f9-4a4c-a14d-020fc198db21",
//  "amount": "1100",
//  "callback_url": "http://aroosk.ir/verify",
//  "description": "توضیحات تست زیبا",
//  "metadata": {
//    "mobile": "09034964636",
//    "email": "zheydari5701@gmail.com"
//  }
//}',
//            CURLOPT_HTTPHEADER => array(
//                'Content-Type: application/json',
//                'Accept: application/json'
//            ),
//        ));
//
//        $response = curl_exec($curl);
//
//        curl_close($curl);
//        echo $response;
    }
}
