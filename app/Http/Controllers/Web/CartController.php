<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class CartController extends Controller
{
    public function index()
    {
        return view('web.cart.index');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addItem(Course $course)
    {
        if(in_array($course->status, ['not_for_sale', 'inactive'])) {
           return back()->with([
               'status' => 'danger',
               'message' => 'دوره غیر قابل خریداری است.',
           ]);
        }
        $id = $course->id;
        $cart = session()->get('cart', []);
        if(empty($cart[$id])) {
            $cart[$id] = [
                'name' => $course->name,
                'price' => $course->price,
                'discount_percent' => $course->discount_percent ?: 0,
                'discounted_price' => !empty($course->discount_percent) ?
                    Course::calculate_discounted_price($course->price, $course->discount_percent) : $course->price,
                'image' => $course->get_cover()
            ];
        }
        session()->put('cart', $cart);
        return back()->with([
            'status' => 'success',
            'message' => 'دوره با موفقیت به سبد خرید اضافه شد!',
        ]);
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function deleteItem(Request $request)
    {
        $course_id = $request->course_id;
        if(empty($course_id)) {
            return;
        }
        $cart = session()->get('cart');
        if(!empty($cart[$course_id])) {
            unset($cart[$course_id]);
            session()->put('cart', $cart);
        }
        session()->flash('status', 'success');
        session()->flash('message', 'دوره با موفقیت از سبد خرید حذف شد.');
    }
}
