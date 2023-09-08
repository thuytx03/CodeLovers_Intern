<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    public function index()
    {
        $data1 = Type::orderBy('parent_id', 'asc')->paginate(10);
        return view(
            'admin.types.index',
            [
                'title' => 'Danh mục bài viết',
                'data1' => $data1
            ]
        );
    }

    public function create()
    {
        return view('admin.types.add', [
            'title' => 'Thêm mới danh mục bài viết',
            'data' => Type::where('parent_id', '=', 0)->get()
        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required | unique:types',
            'slug' => ' unique:types'
        ], [
            'name.required' => 'Vui lòng nhập bài viết',
            'name.unique' => 'Tên danh mục đã tổn tại',
            'slug.unique' => 'Tên đường dẫn đã tổn tại',
        ]);
        $data = new Type();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->parent_id = $request->parent_id;
        if ($request->slug == "") {
            $data->slug = Str::slug($request->name);
        } else {
            $data->slug = Str::slug($request->slug);
        }
        if ($request->hasFile('image')) {
            $data->image = uploadImage('type', $request->file('image'));
        }
        $data->save();
        toastr()->success('Thành công thêm mới danh mục');

        return redirect()->back();
    }

    public function edit($id)
    {
        return view('admin.types.edit', [
            'title' => 'Chỉnh sửa danh mục bài viết',
            'data' => Type::where('parent_id', '=', 0)->get(),
            'value' => Type::find($id)
        ]);
    }
    public function update($id, Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', Rule::unique('types')->ignore($id)],
            'slug' => [Rule::unique('types')->ignore($id)]
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tổn tại',
            'slug.unique' => 'Tên đường dẫn đã tổn tại',
        ]);
        $data = Type::find($id);
        $data->name = $request->name;
        $data->description = $request->description;
        $data->parent_id = $request->parent_id;
        if ($request->slug == "") {
            $data->slug = Str::slug($request->name);
        } else {
            $data->slug = Str::slug($request->slug);
        }
        if ($request->hasFile('image')) {
            $resultImg = Storage::delete('/public/' . $data->image);
            if ($resultImg) {
                $data->image = uploadImage('type', $request->image);
            } else {
                $data->image = $data->image;
            }
        }

        $data->save();
        toastr()->success('Thành công chỉnh sửa danh mục');

        return redirect()->back();
    }
    public function destroy($id)
    {
        $data = Type::find($id);
        $resultImg = Storage::delete('/public/' . $data->image);
        $data->delete();
        toastr()->success('Thành công xoá danh mục');
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            Type::whereIn('id', $ids)->delete();
            toastr()->success('Thành công xóa các danh mục đã chọn');
        } else {
            toastr()->warning('Không tìm thấy các danh mục đã chọn');
        }

        return redirect()->route('list.types');
    }

    public function trash()
    {
        $types = Type::onlyTrashed()->get();
        return view('admin.types.trash', [
            'title' => 'Thùng rác',
            'types' => $types
        ]);
    }
    public function permanentlyDelete($id)
    {
        $types = Type::withTrashed()->findOrFail($id);
        $types->forceDelete();
        // Alert::success('Thành công', 'Thành công xoá vĩnh viễn danh mục');
                  toastr()->success('Thành công xoá vĩnh viễn danh mục');

        return redirect()->route('trash.types');
    }
    public function restore(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            $type = Type::withTrashed()->whereIn('id', $ids);
            $type->restore();
            // Alert::success('Thành công', 'Thành công khôi phục danh mục');
            toastr()->success('Thành công khôi phục danh mục');
        } else {
            // Alert::warning('Thất bại', 'Không tìm thấy các danh mục đã chọn');
            toastr()->warning('Không tìm thấy các danh mục đã chọn');
        }
        return redirect()->route('trash.types');
    }

    public function cleanupTrash()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(1);
        Type::onlyTrashed()->where('deleted_at', '<', $thirtyDaysAgo)->forceDelete();
        return redirect()->route('list.types')->withSuccess('Đã xoá vĩnh viễn các danh mục trong thùng rác');
    }
}
