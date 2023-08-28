<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Logo;
use Exception;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function cart()
    {

        $user = auth()->user();
        $carts = Cart::where('user_id', $user->id)->get();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = NULL;
        }
        return view('client.carts.cart', [
            'title' => 'Giỏ hàng',
            'carts' => $carts,
            'countCart' => $countCart,
            'logo' => Logo::find(1),
        ]);
    }
    public function addToCart(Request $request)
    {

        if ($request->size_id == '') {
            toastr()->warning('Vui lòng nhập kích thước');
            return redirect()->back();
        } else if ($request->color_id == '') {
            toastr()->warning('Vui lòng nhập màu sắc');
            return redirect()->back();
        }
        $user = auth()->user();
        $productId = $request->product_id;
        $sizeId = $request->size_id;
        $colorId = $request->color_id;
        $quantity = $request->quantity;

        // Kiểm tra sản phẩm đã có trong giỏ hàng chưa
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $productId)
            ->where('size_id', $sizeId)
            ->where('color_id', $colorId)
            ->first();

        // Nếu sản phẩm, size,color đã có trong giỏ hàng, tăng số lượng lên 1
        if ($cartItem) {
            $cartItem->quantity += 1;
            if ($cartItem->product->discount_price != NULL) {
                $productPrice = $cartItem->product->discount_price;
                $cartItem->total = $cartItem->quantity * $productPrice;
            } else {
                $productPrice = $cartItem->product->selling_price;
                $cartItem->total = $cartItem->quantity * $productPrice;
            }
            $cartItem->save();
        } else {
            // Nếu sản phẩm chưa có trong giỏ hàng, tạo mới
            $cartItem = new Cart;
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $productId;
            $cartItem->size_id = $sizeId;
            $cartItem->color_id = $colorId;
            $cartItem->quantity = $quantity;
            if ($cartItem->product->discount_price != NULL) {
                $productPrice = $cartItem->product->discount_price;
                $cartItem->total = $cartItem->quantity * $productPrice;
            } else {
                $productPrice = $cartItem->product->selling_price;
                $cartItem->total = $cartItem->quantity * $productPrice;
            }
            $cartItem->save();
        }
        toastr()->success('Thêm giỏ hàng thành công!');
        return redirect()->back();
    }



    public function updateCart(Request $request)
    {
        $cartIds = $request->input('id'); // Lấy danh sách ID giỏ hàng
        $quantities = $request->input('quantity'); // Lấy danh sách số lượng sản phẩm

        // Lặp qua từng ID giỏ hàng và cập nhật số lượng tương ứng
        foreach ($cartIds as $key => $cartId) {
            $cartItem = Cart::find($cartId); // Tìm kiếm mục giỏ hàng theo ID của giỏ hàng

            if ($cartItem) {
                // Cập nhật số lượng sản phẩm trong CSDL theo $quantity
                $cartItem->quantity = $quantities[$key];

                if ($cartItem->product->discount_price != NULL) {
                    $productPrice = $cartItem->product->discount_price;
                    $cartItem->total = $cartItem->quantity * $productPrice;
                } else {
                    $productPrice = $cartItem->product->selling_price;
                    $cartItem->total = $cartItem->quantity * $productPrice;
                }

                $cartItem->save();
            }
        }
        toastr()->success('Thành công cập nhật giỏ hàng');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();
        toastr()->success('Thành công xoá sản phẩm trong giỏ hàng');
        return redirect()->back();
    }
}
