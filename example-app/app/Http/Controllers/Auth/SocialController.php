<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use RealRashid\SweetAlert\Facades\Alert;

class SocialController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'role_id' => 3,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'status' => 1,
                ]);

                Auth::login($newUser);

                return redirect('/');
                toastr()->success( 'Đăng nhập tài khoản thành công');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
