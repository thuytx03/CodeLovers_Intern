<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $data1 = Category::orderBy('parent_id', 'asc')->paginate(10);
        return view(
            'admin.categories.index',
            [
                'title' => 'Danh mục bất động sản',
                'data1' => $data1
            ]
        );
    }

    public function create()
    {
        return view('admin.categories.add', [
            'title' => 'Thêm mới danh mục bất động sản',
            'data' => Category::where('parent_id', '=', 0)->get()
        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required | unique:categories',
            'slug' => ' unique:categories'
        ], [
            'name.required' => 'Vui lòng nhập bất động sản',
            'name.unique' => 'Tên danh mục đã tổn tại',
            'slug.unique' => 'Tên đường dẫn đã tổn tại',
        ]);
        $data = new Category();
        $data->name = $request->name;
        $data->description = $request->description;
        $data->parent_id = $request->parent_id;
        if ($request->slug == "") {
            $data->slug = Str::slug($request->name);
        } else {
            $data->slug = Str::slug($request->slug);
        }
        if ($request->hasFile('image')) {
            $data->image = uploadImage('category', $request->file('image'));
        }
        $data->save();
        // Alert::success('Thành công', 'Thành công thêm mới danh mục');
        toastr()->success('Thành công thêm mới danh mục');

        return redirect()->back();
    }

    public function edit($id)
    {
        return view('admin.categories.edit', [
            'title' => 'Chỉnh sửa danh mục bất động sản',
            'data' => Category::where('parent_id', '=', 0)->get(),
            'value' => Category::find($id)
        ]);
    }
    public function update($id, Request $request)
    {
        $validate = $request->validate([
            'name' => ['required', Rule::unique('categories')->ignore($id)],
            'slug' => [Rule::unique('categories')->ignore($id)]
        ], [
            'name.required' => 'Vui lòng nhập tên danh mục',
            'name.unique' => 'Tên danh mục đã tổn tại',
            'slug.unique' => 'Tên đường dẫn đã tổn tại',
        ]);
        $data = Category::find($id);
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
                $data->image = uploadImage('category', $request->image);
            } else {
                $data->image = $data->image;
            }
        }

        $data->save();
        // Alert::success('Thành công', 'Thành công chỉnh sửa danh mục');
        toastr()->success('Thành công chỉnh sửa danh mục');

        return redirect()->back();
    }
    public function destroy($id)
    {
        $data = Category::find($id);
        $resultImg = Storage::delete('/public/' . $data->image);
        $data->delete();
        toastr()->success('Thành công xoá danh mục');

        // Alert::success('Thành công', 'Thành công xoá danh mục');
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            Category::whereIn('id', $ids)->delete();
            toastr()->success('Thành công xóa các danh mục đã chọn');
            // Alert::success('Thành công', 'Thành công xóa các danh mục đã chọn');
        } else {
            toastr()->warning('Không tìm thấy các danh mục đã chọn');
            // Alert::warning('Thất bại', 'Không tìm thấy các danh mục đã chọn');
        }

        return redirect()->route('list.categories');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.categories.trash', [
            'title' => 'Thùng rác',
            'categories' => $categories
        ]);
    }
    public function permanentlyDelete($id)
    {
        $categories = Category::withTrashed()->findOrFail($id);
        $categories->forceDelete();
        // Alert::success('Thành công', 'Thành công xoá vĩnh viễn danh mục');
                  toastr()->success('Thành công xoá vĩnh viễn danh mục');

        return redirect()->route('trash.categories');
    }
    public function restore(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            $category = Category::withTrashed()->whereIn('id', $ids);
            $category->restore();
            // Alert::success('Thành công', 'Thành công khôi phục danh mục');
            toastr()->success('Thành công khôi phục danh mục');
        } else {
            // Alert::warning('Thất bại', 'Không tìm thấy các danh mục đã chọn');
            toastr()->warning('Không tìm thấy các danh mục đã chọn');
        }
        return redirect()->route('trash.categories');
    }

    public function cleanupTrash()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(1);
        Category::onlyTrashed()->where('deleted_at', '<', $thirtyDaysAgo)->forceDelete();
        return redirect()->route('list.categories')->withSuccess('Đã xoá vĩnh viễn các danh mục trong thùng rác');
    }
}
