<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CouponClientController extends Controller
{
    public function check(Request $request)
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (session()->has('coupon')) {
            return back()->with('error', 'Bạn đã áp dụng một mã giảm giá rồi.');
        }

        if (!$coupon) {
            return back()->with('error', 'Mã giảm giá không tồn tại');
        }

        $now = Carbon::now();
        if ($now->isBefore($coupon->start_date) || $now->isAfter($coupon->end_date)) {
            return back()->with('error', 'Mã giảm giá đã hết hạn');
        }

        if ($coupon->status == 2) {
            return back()->with('error', 'Mã giảm giá đã hết hạn');
        }

        if ($coupon->quantity == 0) {
            return back()->with('error', 'Mã giảm giá đã hết lượt sử dụng');
        }

        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->total;
        }

        $discount = 0;
        $totalCoupon = 0;

        if ($coupon->type == 1 && $coupon->min_order_amount == "" && $coupon->max_order_amount == "") {
            // Giảm tất cả hoá đơn theo %
            $discount = $totalPrice * $coupon->value;
            $totalCoupon = $totalPrice - $discount;
        } elseif (
            $coupon->type == 1 && $coupon->min_order_amount <= $totalPrice && $coupon->max_order_amount >= $totalPrice
            && $coupon->min_order_amount != "" && $coupon->max_order_amount != ""
        ) {
            // Giảm theo % đối với khoảng đơn hàng cụ thể
            $discount = $totalPrice * $coupon->value;
            $totalCoupon = $totalPrice - $discount;
        } elseif ($coupon->type == 1 && $coupon->min_order_amount <= $totalPrice && $coupon->max_order_amount == "") {
            // Giảm theo % đối với đơn hàng trên mức tối thiểu
            $discount = $totalPrice * $coupon->value;
            $totalCoupon = $totalPrice - $discount;
        } elseif ($coupon->type == 1 && $coupon->min_order_amount == "" && $coupon->max_order_amount >= $totalPrice) {
            // Giảm theo % đối với đơn hàng trên mức tối thiểu
            $discount = $totalPrice * $coupon->value;
            $totalCoupon = $totalPrice - $discount;
        } elseif ($coupon->type == 2 && $coupon->min_order_amount == "" && $coupon->max_order_amount == "") {
            // Giảm tất cả hoá đơn theo giá
            $discount = $coupon->value;
            $totalCoupon = $totalPrice - $discount;
        } elseif ($coupon->type == 2 && $coupon->min_order_amount <= $totalPrice && $coupon->max_order_amount >= $totalPrice) {
            // Giảm theo giá đối với khoảng đơn hàng cụ thể
            $discount = $coupon->value;
            $totalCoupon = $totalPrice - $discount;
        } elseif ($coupon->type == 2 && $coupon->min_order_amount <= $totalPrice && $coupon->max_order_amount == "") {
            // Giảm theo giá đối với đơn hàng trên mức tối thiểu
            $discount = $coupon->value;
            $totalCoupon = $totalPrice - $discount;
        } elseif ($coupon->type == 2 && $coupon->min_order_amount == "" && $coupon->max_order_amount >= $totalPrice) {
            // Giảm theo giá đối với đơn hàng trên mức tối thiểu
            $discount = $coupon->value;
            $totalCoupon = $totalPrice - $discount;
        } else {
            // Thông báo lỗi khi mã giảm giá không áp dụng
            if ($coupon->min_order_amount != "" && $coupon->max_order_amount != "") {
                $error = 'Mã giảm giá áp dụng cho đơn từ ' . number_format($coupon->min_order_amount, 0, ',', '.') . ' VNĐ' . ' đến ' . number_format($coupon->max_order_amount, 0, ',', '.') . ' VNĐ';
            } elseif ($coupon->min_order_amount != "") {
                $error = 'Mã giảm giá áp dụng cho đơn từ ' . number_format($coupon->min_order_amount, 0, ',', '.') . ' VNĐ';
            } elseif ($coupon->max_order_amount != "") {
                $error = 'Mã giảm giá áp dụng cho đơn không quá ' . number_format($coupon->max_order_amount, 0, ',', '.') . ' VNĐ';
            }
            return back()->with('error', $error);
        }



        Session::put('coupon', [
            'code' => $coupon->code,
            'discount' => $discount,
            'totalCoupon' => $totalCoupon,
        ]);

        return back()->with('success', 'Áp mã giảm giá thành công');
    }


    public function clearCouponSession( )
    {
        Session::forget('coupon');
        return response()->json(['message' => 'Session giảm giá đã được xoá.']);

    }
}
