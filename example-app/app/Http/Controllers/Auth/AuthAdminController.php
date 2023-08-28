<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdminController extends Controller
{
    public function index(){
        return view('admin.auth.login',[
            'title'=>'Đăng nhập trang quản trị'
        ]);
    }
    public function login(Request $request){
        $validate=$request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Vui lòng nhập email',
            'password.required'=>'Vui lòng nhập mật khẩu'
        ]);
        if(Auth::attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ])){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login.admin')->withErrors([
                'email' => 'Tài khoản và mật khẩu không chính xác',
            ]);;
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login.admin');
    }
}
