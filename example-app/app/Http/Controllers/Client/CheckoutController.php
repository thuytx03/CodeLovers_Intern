<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Checkout\CheckOutRequest;
use App\Models\Cart;
use App\Models\Logo;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Notifications\CheckOut\CheckOutMail;
use App\Utilities\VNPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CheckoutController extends Controller
{
    public function index()
    {
        // Session::forget('coupon');

        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->get();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = NULL;
        }
        $totalPrice = 0;
        foreach ($carts as $cart) {
            $totalPrice += $cart->total;
        }
        return view('client.checkout.index', [
            'title' => 'Mua hàng',
            'carts' => $carts,
            'countCart' => $countCart,
            'logo' => Logo::find(1),
            'totalPrice' => $totalPrice

        ]);
    }
    public function checkout(CheckOutRequest $request)
    {

        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->get();

        $order = new Order();
        $order->name = $request->input('name');
        $order->email = $request->input('email');
        $order->phone = $request->input('phone');
        $order->address = $request->input('address');
        $order->payment = $request->input('payment');
        $order->status = 'Chờ xác nhận';
        $order->note = $request->input('note');
        $order->user_id = $user->id;
        $order->total = $request->totalPrice;
        $order->save();

        // Lưu thông tin chi tiết đơn hàng vào cơ sở dữ liệu
        foreach ($carts as $cart) {
            $orderDetail = new Order_Detail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $cart->product_id;
            $orderDetail->quantity = $cart->quantity;
            $orderDetail->size_id = $cart->size_id;
            $orderDetail->color_id = $cart->color_id;
            $orderDetail->price = $cart->total;
            $orderDetail->save();
        }
        // Trừ số lượng sản phẩm
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            $product->quantity -= $cart->quantity;
            $product->save();
        }

        if ($request->payment == 'pay_later') {
            // Xóa sản phẩm trong giỏ hàng của người dùng
            // Cart::where('user_id', $user->id)->delete();

            // Xoá session giảm giá sau khi đặt hàng thành công
            Session::forget('coupon');

            $order->notify(new CheckOutMail());
            toastr()->success('Đặt hàng thành công');
            return redirect()->back();
        }
        if ($request->payment == 'online_payment') {
            $data_url = VNPay::vnpay([
                'vnp_TxnRef' => $order->id, //order id
                'vnp_OrderInfo' => 'Mô tả',
                'vnp_Amount' => $request->totalPrice // số tiền
            ]);
            return redirect()->to($data_url);
        }
    }

    public function vnPayCheck(Request $request)
    {
        $user = auth()->user();
        $vnp_ResponseCode = $request->get('vnp_ResponseCode');
        $vnp_TxnRef = $request->get('vnp_TxnRef');
        $vnp_Amount = $request->get('vnp_Amount');
        $order = Order::find($vnp_TxnRef);

        if ($vnp_ResponseCode != NULL) {
            if ($vnp_ResponseCode == '00') {
                // Cart::where('user_id', $user->id)->delete();

                // Xoá session giảm giá sau khi đặt hàng thành công
                Session::forget('coupon');

                $order->status = 'Chờ lấy hàng';
                $order->save();
                $order->notify(new CheckOutMail());
                toastr()->success('Đặt hàng thành công');
                return redirect()->back();
            } else {
                toastr()->warning('Thah toán thất bại');
                Order::where('id', $vnp_TxnRef)->delete();
                return redirect()->back();
            }
        }
    }


    public function list()
    {
        $user = auth()->user();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = null;
        }
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->paginate(5); // Số đơn hàng hiển thị trên mỗi trang, trong ví dụ này là 10
        $orderQuantities = [];

        foreach ($orders as $order) {
            $totalQuantity = Order_Detail::where('order_id', $order->id)->sum('quantity');
            $orderQuantities[$order->id] = $totalQuantity;
        }

        return view('client.checkout.list', [
            'title' => 'Đơn hàng',
            'order' => $orders,
            'logo' => Logo::find(1),
            'countCart' => $countCart,
            'orderQuantities' => $orderQuantities
        ]);
    }

    public function cancel(Request $request, $id)
    {
        $order = Order::find($id);
        $cancelReason = $request->input('cancel_reason');

        // Lưu lý do huỷ đơn hàng vào cơ sở dữ liệu (ví dụ: trong trường hợp có cột 'cancel_reason' trong bảng 'orders')
        $order->cancel_reason = $cancelReason;
        $order->status = 'Đã huỷ';
        $order->save();

        // Cập nhật lại số lượng sản phẩm đã mua
        foreach ($order->order_details as $orderDetail) {
            $product = Product::find($orderDetail->product_id);
            $product->quantity += $orderDetail->quantity;
            $product->save();
        }

        // Thực hiện các hành động khác sau khi huỷ đơn hàng
        toastr()->success('Đơn hàng đã được huỷ thành công!');
        return redirect()->back();
    }
}
