<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Product_Color;
use App\Models\Product_Image;
use App\Models\Product_Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(Request $request)
    {
        // session(['previous_url' => url()->previous()]);

        $user = auth()->user();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = NULL;
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
            "countCart" => $countCart,
            'categories' => $categories

        ]);
    }
    public function productDetail($slug, $id)
    {
        // session(['previous_url' => url()->previous()]);

        $user = auth()->user();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = NULL;
        }
        $product = Product::where('slug', $slug)->where('id', $id)->first();

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

        return view('client.shops.productDetail', [
            'title' => $product->name,
            'product' => $product,
            'productColor' => $productColor,
            'productSize' => $productSize,
            'productImage' => $productImage,
            'logo' => Logo::find(1),
            "countCart" => $countCart,
            'relatedProducts'=>$relatedProducts

        ]);
    }
    public function index()
    {
        return view('welcome');
    }
    public function getResult(Request $request){
        $query = $request->get('query');
        $filterResult = Product::where('name', 'LIKE', '%'. $query. '%')->get();
        return response()->json($filterResult);
    }
}
