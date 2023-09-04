<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Detail;
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
        $order_detail=Order_Detail::where('order_id',$order->id)->get();
        return view('admin.orders.detail', [
            'title'=>'Chi tiết hoá đơn',
            'order' => $order,
            'order_detail' => $order_detail
        ]);
    }
    // Chờ xác nhận,chờ lấy hàng, đang giao, đã giao, đã huỷ, trả hàng
    public function confirm($id)
    {
        $order = Order::find($id);
        $order->status = 'Chờ lấy hàng';
        $order->save();
        return redirect()->back();
    }
    public function delivering($id)
    {
        $order = Order::find($id);
        $order->status = 'Đang giao';
        $order->save();
        return redirect()->back();
    }
    public function delivered($id)
    {
        $order = Order::find($id);
        $order->status = 'Đã giao';
        $order->save();
        return redirect()->back();
    }
    public function cancel(Request $request, $id)
    {
        $order = Order::find($id);
        $cancelReason = $request->input('cancel_reason');

        // Lưu lý do huỷ đơn hàng vào cơ sở dữ liệu (ví dụ: trong trường hợp có cột 'cancel_reason' trong bảng 'orders')
        $order->cancel_reason = $cancelReason;
        $order->status = 'Đã huỷ';
        $order->save();

        // Thực hiện các hành động khác sau khi huỷ đơn hàng
        toastr()->success('Đơn hàng đã được huỷ thành công!');
        return redirect()->back();
    }
}
