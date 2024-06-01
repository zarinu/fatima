<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\Request;
use Kavenegar\Laravel\Message\KavenegarMessage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Notification;

class TestController extends Controller
{
    public function main($method)
    {
        if(method_exists($this, $method)) {
            return  $this->$method();
        }
    }

    public function kavenegarMessageTest() {
//        try{
//            foreach (User::all() as $user) {
//                $receptor = $user->mobile;
//                $token = explode(' ', $user->name)[0];
//                $token2 = $user->id;
//                $template = "ImportantMessage";
//                //Send null for tokens not defined in the template
//                //Pass token10 and token20 as parameter 6th and 7th
//                $result = Kavenegar::VerifyLookup($receptor, $token, $token2, null, $template);
////            $result = (new KavenegarMessage())->verifyLookup($template,)->to($this->notifiable->mobile);
////            if($result){
////                foreach($result as $r){
////                    echo "messageid = $r->messageid";
////                    echo "message = $r->message";
////                    echo "status = $r->status";
////                    echo "statustext = $r->statustext";
////                    echo "sender = $r->sender";
////                    echo "receptor = $r->receptor";
////                    echo "date = $r->date";
////                    echo "cost = $r->cost";
////                }
////            }
//
////            dd('پیام ارسال شد برو حال کن');
//
//                if($result) {
//                    echo $user->id;
//                }
//            }
//        }
//        catch(\Kavenegar\Exceptions\ApiException $e){
//            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
//            echo $e->errorMessage();
//        }
//        catch(\Kavenegar\Exceptions\HttpException $e){
//            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
//            echo $e->errorMessage();
//        }
    }

    public function kavenegarExcelMessageTest() {
//        try{
////            $json = \File::get(public_path('/media/users_fandogh.json'));
////            $students = json_decode($json)->Sheet1;
////            foreach ($students as $student) {
////                $receptor = $student->mobile;
////                $receptor = '09377819036';
////                $token = explode(' ', $student->name)[0];
//                $token = 'دوره‌جامع‌لباس‌عروسک';
////                $token2 = 'qPU26i5nHD';
//                $template = "SuccessPayment";
////                Send null for tokens not defined in the template
////                Pass token10 and token20 as parameter 6th and 7th
//                $result = \Kavenegar::VerifyLookup($receptor, $token, null, null, $template);
////            $result = (new KavenegarMessage())->verifyLookup($template,)->to($this->notifiable->mobile);
////            if($result){
////                foreach($result as $r){
////                    echo "messageid = $r->messageid";
////                    echo "message = $r->message";
////                    echo "status = $r->status";
////                    echo "statustext = $r->statustext";
////                    echo "sender = $r->sender";
////                    echo "receptor = $r->receptor";
////                    echo "date = $r->date";
////                    echo "cost = $r->cost";
////                }
////            }
//
//            dd('پیام ارسال شد برو حال کن');
////                dd($student->mobile);
////                if($result) {
////                    echo $student->mobile;
////                }
////            }
//        }
//        catch(\Kavenegar\Exceptions\ApiException $e){
//            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
//            echo $e->errorMessage();
//        }
//        catch(\Kavenegar\Exceptions\HttpException $e){
//            // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
//            echo $e->errorMessage();
//        }
    }

    public function telegram() {
        Notification::send(User::where('role_id', 1)->first(), new \App\Notifications\SendTelegramBot());
    }
}
