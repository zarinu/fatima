<?php

namespace App\Http\Controllers\Web\Panel;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\UserCourse;
use App\Notifications\SuccessPayment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function create()
    {
        $cart = session('cart');
        $user = User::find(auth()->id());

        $price = $cart['price'];
        $discount_price = $cart['total_discount_price'];
        $total_price = $price - $discount_price;

        $result = $this->get_authority($total_price, $user);
        if($result['status'] == 'failed') {
            return redirect('/cart')->with([
                'status' => 'danger',
                'message' => $result['message'],
            ]);
        }
        $authority = $result['authority'];

        $order = Order::create([
            'user_id' => $user->id,
            'discount_id' => !empty($cart['discount_id']) ? $cart['discount_id'] : null,
            'price' => $price,
            'discount_price' => $discount_price,
            'total_price' => $total_price,
            'description' => 'پرداخت توسط درگاه بانکی زرین پال',
            'status' => 'pending',
        ]);
        foreach ($cart['items'] as $course_id => $cart_item) {
            OrderItem::create([
                'user_id' => $user->id,
                'order_id' => $order->id,
                'course_id' => $course_id,
                'price' => $cart_item['price'],
                'discount_price' => $cart_item['discount_price'],
                'total_price' => $cart_item['price'] - $cart_item['discount_price'],
            ]);
        }
        Payment::create([
            'user_id' => $user->id,
            'order_id' => $order->id,
            'amount' => $order->total_price,
            'ref_id' => $authority,
            'name' => $user->name,
            'mobile' => $user->mobile,
            'description' => 'پرداخت توسط درگاه بانکی زرین پال',
            'status' => 'pending',
        ]);
        return $this->connect_to_gateway($authority);
    }

    public function verify(Request $request) {
        $authority = $request->Authority ?: null;
        $payment = Payment::where('ref_id', $authority)->first();
        if(!$payment) {
            return redirect('/cart')->with([
                'status' => 'danger',
                'message' => 'عملیات پرداخت با خطا مواجه گردید. لطفا مجددا تلاش بفرمایید.',
            ]);
        }
        $order = $payment->order;

        if($request->Status != 'OK') {
            $payment->status = 'failed';
            $payment->description = 'عملیات با خطای اولیه لغو توسط کاربر و غیره مواجه گردید.';
            $payment->save();
            $order->status = 'failed';
            $order->save();
            return redirect('/cart')->with([
                'status' => 'danger',
                'message' => 'عملیات پرداخت به درخواست شما لغو گردید.',
            ]);
        }

        $post_data = [
            "merchant_id" => config('payment.zarinpal.merchant_id'),
            "amount" => $payment->amount,
            "authority" => $authority,
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => Payment::paymentUrl('verify_url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $result = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        $result = json_decode($result, true);
        if ($err) {
            $payment->status = 'failed';
            $payment->description = 'خطای هنگام درخواست از طریق cURL';
            $payment->save();
            $order->status = 'failed';
            $order->save();
            return redirect('/cart')->with([
                'status' => 'danger',
                'message' => "cURL Error #:" . $err,
            ]);
        } else {
            if ($result['data']['code'] == 100) {
                // update the payment record values;
                $payment->ref_id = $result['data']['ref_id'];
                $payment->paid_at = time();
                $payment->status = 'success';
                $payment->save();

                // update the order record values
                $order->status = 'success';
                $order->save();

                // empty the shopping bag or cart
                session()->forget('cart');

                // active the courses for user
                if($payment->amount == $order->total_price) {
                    $order_items = $order->items;
                    foreach ($order_items as $item) {
                        UserCourse::firstOrCreate([
                           'user_id' => $item->user_id,
                           'course_id' => $item->course_id,
                        ]);
                        $item->course->increment('users_count');
                    }
                }

                // پیامک های خرید با موفقیت دوره
                $user = $payment->user;
                $user->notify(new SuccessPayment($user->mobile, 'SuccessPayment', 'دوره'));
                $user->notify(new SuccessPayment($user->mobile, 'getChannelLink', 'https://eitaa.com/poshtibani_arosak'));

                return redirect('/panel')->with([
                    'status' => 'success',
                    'message' => 'دوره شما با موفقیت فعال گردید.',
                ]);
            } else {
                $payment->status = 'failed';
                $payment->description = $result['errors']['message'];
                $payment->save();
                $order->status = 'failed';
                $order->save();
                return redirect('/cart')->with([
                    'status' => 'danger',
                    'message' => $result['errors']['message'],
                ]);
            }
        }
    }

    private function get_authority($total_price, $user): array
    {
        $post_data = [
            "merchant_id" => config('payment.zarinpal.merchant_id'),
            "amount" => $total_price,
            "currency" => "IRT",
            "callback_url" => url("/panel/payments/verify"),
            "description" => "توضیحات تراکنش درگاه بانکی زرین پال",
            "metadata" => [
                "mobile" => $user->mobile,
            ],
        ];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => Payment::paymentUrl('request_url'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $result = curl_exec($curl);
        $err = curl_error($curl);
        $result = json_decode($result, true, JSON_PRETTY_PRINT);
        curl_close($curl);

        if ($err) {
            return [
                'status' => 'failed',
                'message' => "cURL Error #:" . $err,
            ];
        } else {
            if (empty($result['errors'])) {
                if ($result['data']['code'] == 100) {
                    return [
                        'status' => 'success',
                        'authority' => $result['data']["authority"],
                    ];
                }
            } else {
                return [
                    'status' => 'failed',
                    'message' => 'Error Code: ' . $result['errors']['code'] . ' ' . $result['errors']['message'],
                ];
            }
        }

        return [
            'status' => 'failed',
            'message' => "خطایی نامعلوم رخ داده است.",
        ];
    }

    private function connect_to_gateway($authority): RedirectResponse
    {
        return redirect()->to(Payment::paymentUrl('start_pay_url') . $authority);
    }
}
