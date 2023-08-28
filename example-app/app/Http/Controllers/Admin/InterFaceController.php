<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class InterFaceController extends Controller
{
    public function logo(Request $request, $id)
    {
        $logo = Logo::find($id);
        if ($request->isMethod('POST')) {
            if ($request->hasFile('image_path')) {
                $removeImg = Storage::delete('public/' . $logo->image_path);
                if ($removeImg) {
                    $logo->image_path = uploadImage('logo', $request->image_path);
                } else {
                    $logo->image_path = $logo->image_path;
                }
            }
            $logo->save();
            // Alert::success('Thành công', 'Thành công thêm mới logo');
            toastr()->success('Thành công thêm mới logo');

        }
        return view('admin.interfaces.logo', [
            'title' => 'Logo',
            'logo' => $logo
        ]);
    }
    public function index()
    {
        return view('admin.interfaces.indexSlider', [
            'title' => 'Quản lý Slider',
            'data' => Slider::paginate(5)
        ]);
    }
    public function create()
    {
        return view('admin.interfaces.addSlider', [
            'title' => 'Thêm mới Slider',
        ]);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'image' => 'required',
            'status' => 'required',
            'content' => 'nullable'
        ], [
            'image.required' => 'Vui lòng nhập ảnh',
            'status.required' => 'Vui lòng nhập trạng thái',
        ]);

        $slider = new Slider();
        $slider->content = $request->content;
        $slider->status = $request->status;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $slider->image = uploadImage('slider', $image);
        }

        $slider->save();

        // Alert::success('Thành công', 'Thành công thêm mới slider');
        toastr()->success('Thành công thêm mới slider');

        return redirect()->back();
    }

    public function edit($id)
    {
        return view('admin.interfaces.editSlider', [
            'title' => 'Chỉnh sửa Slider',
            'data' => Slider::find($id)
        ]);
    }
    public function update(Request $request, $id)
    {
        $slider = Slider::find($id);
        $slider->content = $request->content;
        $slider->status = $request->status;
        if ($request->hasFile('image')) {
            $removeImg=Storage::delete('public/'.$slider->image);
            if($removeImg){
                $image = $request->file('image');
                $slider->image = uploadImage('slider', $image);
            }else{
                $slider->image=$slider->image;
            }

        }
        $slider->save();
        // Alert::success('Thành công', 'Thành công chỉnh sửa slider');
        toastr()->success('Thành công chỉnh sửa slider');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $removeImg=Storage::delete('public/'.$slider->image);
        $slider->delete();
        // Alert::success('Thành công', 'Thành công xoá slider');
        toastr()->success('Thành công xoá slider');

        return redirect()->back();
    }
}
