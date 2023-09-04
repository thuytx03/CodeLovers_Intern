<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Logo;
use Illuminate\Http\Request;

class AboutClientController extends Controller
{
    public function index(){
        $user = auth()->user();
        if($user){
            $countCart = Cart::where('user_id', $user->id)->count();
        }else{
            $countCart=NULL;
        }
        return view('client.about.about',[
            'title'=>'Giới thiệu',
            'logo' => Logo::find(1),
            'countCart'=>$countCart
        ]);
    }
}
