<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $order = Order::latest()->paginate(5);
        return view('admin.orders.index', [
            'title' => "Quản lý đơn hàng",
            'orders' => $order
        ]);
    }
    public function detail($id)
    {
        $order = Order::find($id);
        return view('admin.orders.detail', compact('order'));
    }
    public function confirm($id)
    {
        $order = Order::find($id);
        $order->status = 'Đã xác nhận';
        $order->save();
        return redirect()->back();
    }

    public function cancel($id)
    {
        $order = Order::find($id);
        $order->status = 'Đã huỷ';
        $order->save();
        return redirect()->back();
    }
}
