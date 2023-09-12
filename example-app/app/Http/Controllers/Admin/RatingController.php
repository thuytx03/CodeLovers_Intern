<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;

class RatingController extends Controller
{
    public function index(){
        $rating=Rating::orderBy('created_at','desc')->paginate(6);
        return view('admin.ratings.index',[
            'title'=>'Danh sách đánh giá',
            'rating'=>$rating
        ]);
    }
    public function destroy($id)
    {
        $roles = Rating::findOrFail($id);
        $roles->delete();
        Toastr::success('Thành công', 'Thành công xoá đánh giá');
        return redirect()->route('list.rating');
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            // Xóa vai trò
            Rating::whereIn('id', $ids)->delete();
            Toastr::success('Thành công', 'Thành công xóa các đánh giá đã chọn');
        } else {
            Toastr::warning('Thất bại', 'Không tìm thấy các đánh giá đã chọn');
        }

        return redirect()->route('list.rating');
    }

}
