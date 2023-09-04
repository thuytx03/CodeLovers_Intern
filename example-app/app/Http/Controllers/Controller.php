<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Logo;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    protected $countCart;
    protected $logo;

    public function __construct()
    {
        $user = auth()->user();
        if($user){
            $this->countCart = Cart::where('user_id', $user->id)->count();
        }else{
            $this->countCart=NULL;
        }
        $this->logo = Logo::find(1);
    }
}
