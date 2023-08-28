<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Logo;
use App\Models\User;
use App\Notifications\Auth\ForgotPasswordMail;
use App\Notifications\Auth\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Yoeunes\Toastr\Facades\Toastr;

class AuthClientController extends Controller
{

    public function login()
    {
        // Lưu trang hiện tại vào session
        session(['previous_url' => url()->previous()]);
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('client.auth.login', [
                'title' => 'Đăng nhập',
                'logo' => Logo::find(1),

            ]);
        }
    }


    public function saveLogin(Request $request)
    {
        // $previousUrl = session()->get('previous_url');
        // dd($previousUrl);
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'password.required' => 'Vui lòng nhập mật khẩu'
        ]);
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            toastr()->success('Đăng nhập tài khoản thành công');
            // Kiểm tra và chuyển hướng trở lại trang trước đó
            if (session()->has('previous_url')) {
                $previousUrl = session('previous_url');
                session()->forget('previous_url');
                return redirect($previousUrl);
            } else {
                // Nếu không có trang trước đó, chuyển hướng đến trang mặc định
                return redirect()->route('/');
            }
        } else {
            return redirect()->route('login.client')->withErrors([
                'email' => 'Tài khoản và mật khẩu không chính xác',
            ]);;
        }
    }


    public function register()
    {

        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('client.auth.register', [
                'title' => 'Đăng ký',
                'logo' => Logo::find(1),

            ]);
        }
    }

    public function saveRegister(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'enter_password' => 'required'
        ], [
            'name.required' => 'Vui lòng nhập họ và tên',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'enter_password.required' => 'Vui lòng nhập lại mật khẩu'
        ]);
        if ($request->enter_password == $request->password) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->avatar = "https://cdn2.iconfinder.com/data/icons/avatar-flat-6/614/Page_19-512.png";
            $user->role_id = 3;
            $user->status = 1;
            $user->save();
            Alert::success('Thành công', 'Đăng ký tài khoản thành công');
            // Gửi email
            $user->notify(new RegisterMail());

            return redirect()->back();
        } else {
            Alert::error('Thất bại', 'Đăng ký tài khoản không thành công');
            return redirect()->back()->withErrors([
                'password' => 'Mật khẩu không trùng khớp'
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function forgotPassword()
    {

        return view('client.auth.forgot', [
            'logo' => Logo::find(1),
            'title' => 'Quên mật khẩu',

        ]);
    }

    public function saveForgotPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $code = mt_rand(100000, 999999);
            $user->password = bcrypt($code);
            $user->save();
            $user->notify(new ForgotPasswordMail($code));
            Alert::success('Thành công', 'Mật khẩu đã được gửi về email của bạn!');
            return redirect()->back();
        } else {
            Alert::error('Thất bại', 'Lấy lại mật khẩu không thành công');
            return redirect()->back()->withErrors([
                'email' => 'Email không tồn tại'
            ]);
        }
    }
}
