<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yoeunes\Toastr\Facades\Toastr;

class UserController extends Controller
{
    public function index(){
        $users=User::paginate(5);
        return view('admin.users.index',[
        'title'=>'Quản lý tài khoản',
        'users'=>$users,
    ]);
    }

    public function create(){
        return view('admin.users.add',[
            'title'=>'Trang thêm mới tài khoản',
            'roles'=>Role::all()
        ]);
    }
    public function store(Request $request){
        $validate=$request->validate([
            'name'=>'required',
            'email'=>'required | unique:users',
            'role_id'=>'required ',
            'phone'=>'required ',
            'address'=>'required',
            'gender'=>'required',
            'password'=>'required',
            'enter_password'=>'required',
        ],[
            'name.required'=>'Vui lòng nhập họ và tên ',
            'email.required'=>'Vui lòng nhập email',
            'email.unique'=>'Email đã tồn tại',
            'role_id.required'=>'Vui lòng nhập vai trò',
            'phone.required'=>'Vui lòng nhập số điện thoại',
            'address.required'=>'Vui lòng nhập địa chỉ',
            'gender.required'=>'Vui lòng nhập giới tính',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'enter_password.required'=>'Vui lòng nhập lại mật khẩu',
        ]);

        if($request->password==$request->enter_password){
            $user=new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->role_id=$request->role_id;
            $user->phone=$request->phone;
            $user->address=$request->address;
            $user->gender=$request->gender;
            $user->status=1;
            $user->avatar="https://cdn2.iconfinder.com/data/icons/avatar-flat-6/614/Page_19-512.png";
            $user->password = bcrypt($request->password);
            $user->save();
            Toastr::success('Thành công', 'Thành công thêm mới tài khoản');
            return redirect()->back();

        }else{
            return redirect()->back()->withErrors([
                'password' =>'Mật khẩu không trùng khớp'
            ]);
        }
    }

    public function destroy($id){
        $user=User::findOrFail($id);
        $user->delete();
        Toastr::success('Thành công', 'Thành công xoá tài khoản');
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        if($ids){
            User::whereIn('id', $ids)->delete();
            Toastr::success('Thành công', 'Thành công xoá các vai trò đã chọn');
        }else{
            Toastr::warning('Thất bại', 'Không tìm thấy các vai trò đã chọn');

        }
        return redirect()->back();
    }

    public function edit($id){
        $user=User::find($id);
        $role=Role::all();
        return view('admin.users.edit',[
            'title'=>'Trang chỉnh sửa tài khoản',
            'roles'=>$role,
            'users'=>$user
        ]);
    }

    public function update($id, Request $request)
{
    $validate = $request->validate([
        'name' => 'required',
        'email' => ['required', Rule::unique('users')->ignore($id)],
        'role_id' => 'required',
        'phone' => 'required',
        'address' => 'required',
        'gender' => 'required',
        'password' => 'nullable|required_with:enter_password',
        'enter_password' => 'nullable|required_with:password|same:password',
    ], [
        'name.required' => 'Vui lòng nhập họ và tên',
        'email.required' => 'Vui lòng nhập email',
        'email.unique' => 'Email đã tồn tại',
        'role_id.required' => 'Vui lòng nhập vai trò',
        'phone.required' => 'Vui lòng nhập số điện thoại',
        'address.required' => 'Vui lòng nhập địa chỉ',
        'gender.required' => 'Vui lòng nhập giới tính',
        'password.required_with' => 'Vui lòng nhập mật khẩu',
        'enter_password.required_with' => 'Vui lòng nhập lại mật khẩu',
        'enter_password.same' => 'Mật khẩu không trùng khớp',
    ]);

    $user = User::find($id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->role_id = $request->role_id;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->gender = $request->gender;
    $user->status = $request->status;
    $user->avatar = "https://cdn2.iconfinder.com/data/icons/avatar-flat-6/614/Page_19-512.png";

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    Toastr::success('Thành công', 'Thành công chỉnh sửa tài khoản');
    return redirect()->back();
}


    public function trash()
    {
        $users = User::onlyTrashed()->get();
        return view('admin.users.trash', [
            'title' => 'Thùng rác',
            'users' => $users
        ]);
    }
    public function permanentlyDelete($id){
        $users = User::withTrashed()->findOrFail($id);
        $users->forceDelete();
        Toastr::success('Thành công', 'Thành công xoá vĩnh viễn người dùng');
        return redirect()->route('trash.user');
    }
    public function restore(Request $request)
    {
        $ids = $request->ids;
        if($ids){
            $user = User::withTrashed()->whereIn('id', $ids);
            $user->restore();
            Toastr::success('Thành công', 'Thành công khôi phục người dùng');
        }else{
            Toastr::warning('Thất bại', 'Không tìm thấy các người dùng đã chọn');
        }
        return redirect()->route('trash.user');
    }

    public function cleanupTrash()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(1);
        User::onlyTrashed()->where('deleted_at', '<', $thirtyDaysAgo)->forceDelete();

        return redirect()->route('list.user')->withSuccess('Đã xoá vĩnh viễn người dùng trong thùng rác');
    }
}
