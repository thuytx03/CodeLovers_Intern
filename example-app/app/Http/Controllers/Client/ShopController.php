<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Product_Color;
use App\Models\Product_Image;
use App\Models\Product_Size;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function shop(){
        // session(['previous_url' => url()->previous()]);

        $user = auth()->user();
        if($user){
            $countCart = Cart::where('user_id', $user->id)->count();
        }else{
            $countCart=NULL;
        }
        return view('client.shops.shop',[
            'title' => 'Cửa hàng',
            'logo'=>Logo::find(1),
            'products'=>Product::paginate(12),
            "countCart" => $countCart

        ]);
    }
    public function productDetail($slug,$id){
        // session(['previous_url' => url()->previous()]);

        $user = auth()->user();
        if($user){
            $countCart = Cart::where('user_id', $user->id)->count();
        }else{
            $countCart=NULL;
        }
        $product=Product::where('slug',$slug)->where('id',$id)->first();

        $productColor=Product_Color::where('product_id',$product->id)->get();
        $productSize=Product_Size::where('product_id',$product->id)->get();
        $productImage=Product_Image::where('product_id',$product->id)->get();

        return view('client.shops.productDetail',[
            'title'=>$product->name,
            'product' => $product,
            'productColor'=>$productColor,
            'productSize'=>$productSize,
            'productImage'=>$productImage,
            'logo'=>Logo::find(1),
            "countCart" => $countCart

        ]);
    }
}
