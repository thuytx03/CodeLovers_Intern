<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Logo;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Product_Color;
use App\Models\Product_Image;
use App\Models\Product_Size;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        // session(['previous_url' => url()->previous()]);

        $user = auth()->user();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = null;
        }
        $categories = Category::orderBy('parent_id', 'asc')->get();

        $selectedCategoryId = $request->input('category');
        $productQuery = Product::query();
        if ($selectedCategoryId) {
            $productQuery->whereHas('categories', function ($query) use ($selectedCategoryId) {
                $query->where('category_id', $selectedCategoryId);
            });
        }

        $product = $productQuery->paginate(12);

        return view('client.shops.shop', [
            'title' => 'Cửa hàng',
            'logo' => Logo::find(1),
            'products' => $product,
            'countCart' => $countCart,
            'categories' => $categories,
        ]);
    }
    public function productDetail($slug, $id, Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = null;
        }
        $product = Product::where('slug', $slug)
            ->where('id', $id)
            ->first();

        $productColor = Product_Color::where('product_id', $product->id)->get();
        $productSize = Product_Size::where('product_id', $product->id)->get();
        $productImage = Product_Image::where('product_id', $product->id)->get();
        $product->view++;
        $product->save();

        // Truy cập danh mục của sản phẩm chi tiết
        $category = $product->categories()->first();

        // Tải danh sách sản phẩm có cùng danh mục
        $relatedProducts = Product::whereHas('categories', function ($query) use ($category) {
            $query->where('category_id', $category->id);
        })
            ->where('id', '!=', $product->id) // Loại bỏ sản phẩm chi tiết
            ->get();

        $ratings = Rating::orderBy('created_at','desc')->where('product_id', $product->id)->get(); // Lấy bộ sưu tập các đánh giá
        $ratingData = []; // Tạo một mảng để chứa tất cả thông tin đánh giá và hình ảnh

        foreach ($ratings as $rating) {
            $imageArrayJson = $rating->image; // Lấy trường image từ mỗi bản ghi
            $imageArray = json_decode($imageArrayJson, true); // Giải mã mảng JSON
            $ratingData[] = [
                'rating' => $rating,
                'imageArray' => $imageArray,
            ];
        }

        // Kiểm tra xem người dùng đã mua sản phẩm hay chưa
        $userHasPurchased = false; // Mặc định là chưa mua
        $userHasReviewed = false; // Mặc định là chưa đánh giá
        $newestOrder = null; // Đơn hàng mới nhất

        if (Auth::check()) {
            $userId = Auth::user()->id;

            // Lấy tất cả các đơn hàng đã giao của người dùng
            $orders = Order::where('user_id', $userId)
            ->where('status','=','Đã giao')
                ->with('order_details')
                ->get();

            // Duyệt qua các đơn hàng
            foreach ($orders as $order) {
                // Kiểm tra xem đơn hàng này có chứa sản phẩm cần đánh giá không
                $hasProduct = $order->order_details->contains('product_id', $product->id);

                if ($hasProduct) {
                    // Kiểm tra xem người dùng đã đánh giá sản phẩm này chưa
                    $hasReviewed = $order->order_details
                        ->where('product_id', $product->id)
                        ->where('status', null)
                        ->isNotEmpty();

                    if ($hasReviewed) {
                        // Người dùng đã mua sản phẩm và chưa đánh giá
                        if ($newestOrder === null || $order->created_at > $newestOrder->created_at) {
                            $newestOrder = $order; // Lưu đơn hàng mới nhất
                        }
                        $userHasPurchased = true;
                        $userHasReviewed = false;
                    } else {
                        // Người dùng đã đánh giá sản phẩm này
                        $userHasReviewed = true;
                    }
                }
            }
        }

        // Lấy `order_id` của đơn hàng mới nhất mà người dùng đã mua sản phẩm A
        // if ($newestOrder) {
        //     $newestOrderId = $newestOrder->id;
        //     dd($newestOrderId);
        // }



        return view('client.shops.productDetail', [
            'title' => $product->name,
            'product' => $product,
            'productColor' => $productColor,
            'productSize' => $productSize,
            'productImage' => $productImage,
            'logo' => Logo::find(1),
            'countCart' => $countCart,
            'relatedProducts' => $relatedProducts,
            'ratingData' => $ratingData,
            'userHasPurchased' => $userHasPurchased,
            'userHasReviewed' => $userHasReviewed,
        ]);
    }
    public function index()
    {
        return view('welcome');
    }
    public function getResult(Request $request)
    {
        $query = $request->get('query');
        $filterResult = Product::where('name', 'LIKE', '%' . $query . '%')->get();
        return response()->json($filterResult);
    }
}
