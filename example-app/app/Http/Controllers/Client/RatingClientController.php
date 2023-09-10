<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingClientController extends Controller
{

    public function store(Request $request)
    {
        $validate = $request->validate([
            'rating' => 'required',
        ]);

        // Lấy người dùng hiện tại
        $user = auth()->user();
        // Người dùng đã mua sản phẩm, cho phép họ đánh giá
        $uploadedImages = [];

        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $uploadedImages[] = uploadImage('rating', $image);
            }
        }
        $rating = Rating::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'review' => $request->review,

        ]);
        // Lưu các hình ảnh đã tải lên vào đánh giá (rating)
        $rating->image = $uploadedImages;
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $rating->video = uploadImage('rating', $video);
        } else {
            $rating->video = NUll;
        }
        $rating->save();
        // Cập nhật trạng thái 'status' trong bảng 'order_detail' thành 1
        $orderDetail = Order_Detail::where('product_id', $request->product_id)
        ->where('status',null)
        ->first();

        if ($orderDetail) {
            $orderDetail->status = 1;
            $orderDetail->save();
        }

        if ($rating->id) {
            toastr()->success('Đánh giá thành công');
            return redirect()->back();
        }
    }
}
