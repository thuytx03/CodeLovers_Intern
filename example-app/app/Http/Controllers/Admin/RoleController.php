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

class RoleController extends Controller
{
    public function index()
    {


        return view('admin.roles.index', [
            'title' => 'Trang quản lý vai trò',
            'roles' => Role::paginate(8),
        ]);
    }
    public function create()
    {
        return view('admin.roles.add', [
            'title' => 'Trang thêm mới vai trò'
        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:roles'
        ], [
            'name.required' => 'Vui lòng nhập tên vai trò',
            'name.unique' => 'Tên vai trò đã tồn tại'
        ]);
        $roles = new Role();
        $roles->name = $request->name;
        $roles->save();
        Toastr::success('Thành công', 'Thành công thêm mới vai trò');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $roles = Role::findOrFail($id);
        $roles->delete();
        Toastr::success('Thành công', 'Thành công xoá vai trò');
        return redirect()->route('list.role');
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            // Xóa vai trò
            Role::whereIn('id', $ids)->delete();
            Toastr::success('Thành công', 'Thành công xóa các vai trò đã chọn');
        } else {
            Toastr::warning('Thất bại', 'Không tìm thấy các vai trò đã chọn');
        }

        return redirect()->route('list.role');
    }

    public function edit($id)
    {
        return view('admin.roles.edit', [
            'title' => "Trang cập nhật vai trò",
            'roles' => Role::findOrFail($id)
        ]);
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => ['required', Rule::unique('roles')->ignore($id)],
        ], [
            'name.required' => 'Vui lòng nhập tên vai trò',
            'name.unique' => 'Tên vai trò đã tồn tại',
        ]);

        $roles = Role::find($id);
        $roles->name = $request->name;
        $roles->save();
        Toastr::success('Thành công', 'Thành công chỉnh sửa vai trò');
        return redirect()->route('list.role');
    }

    public function trash()
    {

        $roles = Role::onlyTrashed()->get();
        return view('admin.roles.trash', [
            'title' => 'Thùng rác',
            'roles' => $roles
        ]);
    }
    public function permanentlyDelete($id)
    {
        $roles = Role::withTrashed()->findOrFail($id);
        $roles->forceDelete();
        Toastr::success('Thành công', 'Thành công xoá vĩnh viễn vai trò');
        return redirect()->route('trash.role');
    }
    public function restore(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            $role = Role::withTrashed()->whereIn('id', $ids);
            $role->restore();
            Toastr::success('Thành công', 'Thành công khôi phục vai trò');
        } else {
            Toastr::warning('Thất bại', 'Không tìm thấy các vai trò đã chọn');
        }

        return redirect()->route('trash.role');
    }

    public function cleanupTrash()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(1);
        Role::onlyTrashed()->where('deleted_at', '<', $thirtyDaysAgo)->forceDelete();

        return redirect()->route('list.role')->withSuccess('Đã xoá vĩnh viễn các vai trò trong thùng rác');
    }
}
