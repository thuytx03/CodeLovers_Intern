<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Logo;
use App\Notifications\Contact\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactClientController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = NULL;
        }
        if ($request->isMethod('POST')) {
            $validate = $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'message' => 'required',
            ], [
                'name.required' => 'Vui lòng nhập tên',
                'email.required' => 'Vui lòng nhập email',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'message.required' => 'Vui lòng nhập nội dung',
            ]);
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->message = $request->message;
            $contact->status = 1;
            $contact->save();
            toastr()->success('Gửi liên hệ thành công');
            $contact->notify(new ContactMail());
            return redirect()->back();
        }
        return view('client.contact.contact', [
            'title' => 'Liên hệ',
            'logo' => Logo::find(1),
            'countCart' => $countCart
        ]);
    }
}
