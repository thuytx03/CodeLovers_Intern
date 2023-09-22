<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yoeunes\Toastr\Facades\Toastr;

class PermissionController extends Controller
{
    
    public function index()
    {
        $permission = Permission::all()->groupBy('group');
        return view('admin.permissions.index', [
            'title' => 'Trang quản lý quyền',
            'permission' => $permission,
        ]);
    }
    public function create()
    {
        return view('admin.permissions.add', [
            'title' => 'Trang thêm mới quyền',
        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:permissions',

        ], [
            'name.required' => 'Vui lòng nhập tên quyền',

        ]);
        $role = Permission::create(
            [
                'name' => $request->input('name'),
                'display_name' => $request->input('display_name'),
                'group' => $request->input('group')
            ]
        );
        Toastr::success('Thành công', 'Thành công thêm mới quyền');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        Toastr::success('Thành công', 'Thành công xoá quyền');
        return redirect()->route('list.permission');
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            // Xóa quyền
            Permission::whereIn('id', $ids)->delete();
            Toastr::success('Thành công', 'Thành công xóa các quyền đã chọn');
        } else {
            Toastr::warning('Thất bại', 'Không tìm thấy các quyền đã chọn');
        }

        return redirect()->route('list.permission');
    }
    public function edit($id)
    {
        $permission = Permission::findOrFail($id);

        return view('admin.permissions.edit', [
            'title' => "Trang cập nhật quyền",
            'permission' => $permission,
        ]);
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate([
            'name' => ['required', Rule::unique('permissions')->ignore($id)],
        ], [
            'name.required' => 'Vui lòng nhập tên quyền',
            'name.unique' => 'Tên quyền đã tồn tại',
        ]);

        $permission = Permission::find($id);
        $permission->name = $request->input('name');
        $permission->display_name = $request->input('display_name');
        $permission->group = $request->input('group');
        $permission->save();


        Toastr::success('Thành công', 'Thành công chỉnh sửa quyền');
        return redirect()->route('list.permission');
    }
}
