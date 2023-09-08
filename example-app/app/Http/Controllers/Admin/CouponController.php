<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(5);
        foreach ($coupons as $coupon) {
            $coupon->checkAndSetStatus();
        }
        return view('admin.coupons.index', [
            'title' => 'Quản lý mã giảm giá',
            'coupons' => $coupons
        ]);
    }
    public function add(Request $request)
    {
        if ($request->isMethod('POST')) {

            $coupon = new Coupon();
            $coupon->code = $request->code;

            $coupon->type = $request->type;
            if ($request->type == 1) {
                //loại giảm giá theo %
                $coupon->value = $request->value ;
                // $coupon->value = $request->value / 100;
            } else if ($request->type == 2) {
                $coupon->value = $request->value;
            }
            $coupon->quantity = $request->quantity;
            $coupon->min_order_amount = $request->min_order_amount;
            $coupon->max_order_amount = $request->max_order_amount;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->description = $request->description;
            $coupon->status = 1;

            $coupon->save();
            if ($coupon->id) {
                toastr()->success('Thành công thêm mới mã giảm giá');
                return redirect()->back();
            }
        }
        return view('admin.coupons.add', [
            'title' => 'Thêm mới mã giảm giá'
        ]);
    }
    public function edit($id, Request $request)
    {
        $coupon = Coupon::find($id);

        if ($request->isMethod('POST')) {

            $coupon->code = $request->code;
            $coupon->type = $request->type;
            if ($request->type == 1) {
                //loại giảm giá theo %
                $coupon->value = $request->value ;
                // $coupon->value = $request->value / 100;
            } else if ($request->type == 2) {
                $coupon->value = $request->value;
            }
            $coupon->quantity = $request->quantity;
            $coupon->min_order_amount = $request->min_order_amount;
            $coupon->max_order_amount = $request->max_order_amount;
            $coupon->start_date = $request->start_date;
            $coupon->end_date = $request->end_date;
            $coupon->description = $request->description;
            $coupon->status = 1;

            $coupon->save();
            // if($coupon->id){
            toastr()->success('Thành công thêm mới mã giảm giá');
            return redirect()->back();
            // }
        }
        return view('admin.coupons.edit', [
            'title' => 'Thêm mới mã giảm giá',
            'coupon' => $coupon
        ]);
    }
    public function destroy($id)
    {
        $data = Coupon::find($id);
        $data->delete();
        toastr()->success('Thành công xoá mã giảm giá');
        return redirect()->back();
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            Coupon::whereIn('id', $ids)->delete();
            toastr()->success('Thành công xóa các mã giảm giá đã chọn');
        } else {
            toastr()->warning('Không tìm thấy các mã giảm giá đã chọn');
        }

        return redirect()->route('list.coupon');
    }
}
