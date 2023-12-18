<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kavenegar;
//use Kavenegar\Laravel\Message\KavenegarMessage;

class TestController extends Controller
{
    public function main($method)
    {
        if(method_exists($this, $method)) {
            return  $this->$method();
        }
    }

    public function kavenegarMessageTest() {
        try{
            $receptor = "09034964636";
            $token = "حانیه";
            $token2 = "456";
            $template="ImportantMessage";
            //Send null for tokens not defined in the template
            //Pass token10 and token20 as parameter 6th and 7th
            $result = Kavenegar::VerifyLookup($receptor, $token, $token2, null, $template);
//            $result = (new KavenegarMessage())->verifyLookup($template,)->to($this->notifiable->mobile);
            if($result){
                foreach($result as $r){
                    echo "messageid = $r->messageid";
                    echo "message = $r->message";
                    echo "status = $r->status";
                    echo "statustext = $r->statustext";
                    echo "sender = $r->sender";
                    echo "receptor = $r->receptor";
                    echo "date = $r->date";
                    echo "cost = $r->cost";
                }
            }

            dd('پیام ارسال شد برو حال کن');
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
            echo $e->errorMessage();
        }
    }
}