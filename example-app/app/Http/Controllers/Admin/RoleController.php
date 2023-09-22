<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
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
        $permission = Permission::all()->groupBy('group');
        return view('admin.roles.add', [
            'title' => 'Trang thêm mới vai trò',
            'permission' => $permission
        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|unique:roles',

        ], [
            'name.required' => 'Vui lòng nhập tên vai trò',
            'name.unique' => 'Tên vai trò đã tồn tại'
        ]);
        $role = Role::create(
            [
                'name' => $request->input('name'),
                'display_name' => $request->input('display_name'),
                'group' => $request->input('group')

            ]

        );
        $role->syncPermissions($request->input('permission'));

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

    // public function show($id)
    // {
    //     $role = Role::find($id);
    //     $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
    //         ->where("role_has_permissions.role_id",$id)
    //         ->get();
    //         $title='index';

    //     return view('admin.roles.show',compact('role','rolePermissions','title'));
    // }

    public function edit($id)
    {
        $permission = Permission::all()->groupBy('group');
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('admin.roles.edit', [
            'title' => "Trang cập nhật vai trò",
            'roles' => Role::findOrFail($id),
            'permission' => $permission,
            'rolePermissions' => $rolePermissions
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

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->display_name = $request->input('display_name');
        $role->group = $request->input('group');
        $role->save();

        $role->syncPermissions($request->input('permission'));

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
