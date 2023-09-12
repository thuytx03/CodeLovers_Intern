<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Logo;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(){
        $user = auth()->user();
        if($user){
            $countCart = Cart::where('user_id', $user->id)->count();
        }else{
            $countCart=NULL;
        }
        $blog=Blog::orderBy('created_at','desc')->paginate(3);
        return view('client.layouts.main',[
            'title'=>'Trang chủ',
            'logo'=>Logo::find(1),
            'slider'=>Slider::all(),
            'products'=>Product::paginate(16),
            "countCart" => $countCart,
            'blog'=>$blog
        ]);
    }


}
