<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        return view('admin.contact.index',[
            'title' => 'Liên hệ tư vấn',
            'data' => Contact::paginate(5)
        ]);
    }
    public function confirm(Request $request,$id){
        $contact=Contact::find($id);
        $contact->status=2;
        $contact->save();
        return redirect()->back();
    }
}
