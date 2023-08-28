<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Yoeunes\Toastr\Facades\Toastr;

class ProductAttributeController extends Controller
{
    public function indexColor()
    {
        $colors = Color::paginate(5);
        return view('admin.attributes.indexColor', [
            'title' => 'Màu sắc sản phẩm',
            'colors' => $colors,
        ]);
    }

    public function indexSize()
    {
        $sizes = Size::paginate(5);
        return view('admin.attributes.indexSize', [
            'title' => 'Kích thước sản phẩm',
            'sizes' => $sizes
        ]);
    }

    public function addColor(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validate = $request->validate([
                'name' => 'required|unique:colors'
            ], [
                'name.required' => 'Vui lòng nhập tên màu sắc',
                'name.unique' => 'Tên màu sắc đã tồn tại',

            ]);
            $params = $request->except('_token');
            $color = Color::create($params);
            if ($color->id) {
                Alert::success('Thành công', 'Thành công thêm mới màu sắc sản phẩm');
                toastr()->success('Thành công thêm mới màu sắc sản phẩm');

                return redirect()->back();
            }
        }
        return view('admin.attributes.addColor', [
            'title' => 'Thêm mới màu sắc sản phẩm'
        ]);
    }
    public function editColor(Request $request, $id)
    {
        $color = Color::find($id);
        if ($request->isMethod('POST')) {
            $validate = $request->validate([
                'name' => ['required', Rule::unique('colors')->ignore($id)]
            ], [
                'name.required' => 'Vui lòng nhập tên màu sắc',
                'name.unique' => 'Tên màu sắc đã tồn tại',
            ]);
            $params = $request->except('_token');
            $data = $color->update($params);
            if ($data) {
                // Alert::success('Thành công', 'Thành công cập nhật màu sắc sản phẩm');
                toastr()->success('Thành công cập nhật màu sắc sản phẩm');

                return redirect()->back();
            }
        }
        return view('admin.attributes.editColor', [
            'title' => 'Cập nhật màu sắc sản phẩm',
            'color' => $color
        ]);
    }
    public function destroyColor($id)
    {
        $color = Color::find($id);
        $color->delete();
        // Alert::success('Thành công', 'Thành công xoá màu sắc sản phẩm');
        toastr()->success('Thành công xoá màu sắc sản phẩm');

        return redirect()->back();
    }
    public function deleteAllColor(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            Color::whereIn('id', $ids)->delete();
            // Alert::success('Thành công', 'Thành công xóa các màu sắc đã chọn');
            toastr()->success('Thành công xóa các màu sắc đã chọn');

        } else {
            // Alert::warning('Thất bại', 'Không tìm thấy các màu sắc đã chọn');
            toastr()->warning('Không tìm thấy các màu sắc đã chọn');

        }
        return redirect()->back();
    }

    public function addSize(Request $request)
    {
        if ($request->isMethod('POST')) {
            $validate = $request->validate([
                'name' => 'required|unique:sizes'
            ], [
                'name.required' => 'Vui lòng nhập kích thước',
                'name.unique' => 'Kích thước đã tồn tại',

            ]);
            $params = $request->except('_token');
            $size = Size::create($params);
            if ($size->id) {
                Alert::success('Thành công', 'Thành công thêm mới kích thước sản phẩm');
                return redirect()->back();
            }
        }
        return view('admin.attributes.addSize', [
            'title' => 'Thêm mới kích thước sản phẩm'
        ]);
    }
    public function editSize(Request $request, $id)
    {
        $size = Size::find($id);
        if ($request->isMethod('POST')) {
            $validate = $request->validate([
                'name' => ['required', Rule::unique('sizes')->ignore($id)]
            ], [
                'name.required' => 'Vui lòng nhập kích thước',
                'name.unique' => 'Kích thước đã tồn tại',
            ]);
            $params = $request->except('_token');
            $data = $size->update($params);
            if ($data) {
                Alert::success('Thành công', 'Thành công cập nhật kích thước sản phẩm');
                return redirect()->back();
            }
        }
        return view('admin.attributes.editSize', [
            'title' => 'Cập nhật kích thước sản phẩm',
            'size' => $size
        ]);
    }
    public function destroySize($id)
    {
        $size = Size::find($id);
        $size->delete();
        Toastr::success('Thành công', 'Thành công xoá kích thước sản phẩm');
        return redirect()->back();
    }

    public function deleteAllSize(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            Size::whereIn('id', $ids)->delete();
            Toastr::success('Thành công', 'Thành công xóa các kích thước đã chọn');
        } else {
            Toastr::warning('Thất bại', 'Không tìm thấy các kích thước đã chọn');
        }
        return redirect()->back();
    }

    public function trashColor()
    {
        $colors = Color::onlyTrashed()->get();
        return view('admin.attributes.trashColor', [
            'title' => 'Thùng rác',
            'colors' => $colors,
        ]);
    }
    public function trashSize()
    {
        $sizes = Size::onlyTrashed()->get();
        return view('admin.attributes.trashSize', [
            'title' => 'Thùng rác',
            'sizes' => $sizes,
        ]);
    }
}
