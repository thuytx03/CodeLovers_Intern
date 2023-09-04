<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->startOfDay(); //lấy ngày
        // đơn hàng mới trong ngày
        $newOrderCount = Order::whereDate('created_at', $today)->count();
        //doanh thu trong ngày
        $revenue = Order::whereDate('created_at', $today)->sum('total');
        // đơn hàng trong trạng thái chờ xác nhận
        $pendingOrdersCount = Order::where('status', 'Chờ xác nhận')->whereDate('created_at', $today)->count();

        // lấy top 10sp có view cao nhất
        $topProductsMonth = Product::orderBy('view', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', [
            'title' => 'Dashboard',
            'newOrderCount' => $newOrderCount,
            'revenue' => $revenue,
            'pendingOrdersCount' => $pendingOrdersCount,
            'topProductsMonth' => $topProductsMonth,

        ]);
    }
}
