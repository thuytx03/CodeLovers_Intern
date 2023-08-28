<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Product_Category;
use App\Models\Product_Color;
use App\Models\Product_Image;
use App\Models\Product_Size;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', [
            'title' => "Quản lý sản phẩm",
            'products' => Product::latest()->paginate(5),
        ]);
    }
    public function create()
    {
        return view('admin.products.add', [
            'title' => 'Thêm mới sản phẩm',
            'data' => Category::orderBy('parent_id', 'asc')->get(),
            'size' => Size::all(),
            'color' => Color::all()
        ]);
    }
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->brand = $request->brand;
        $product->selling_price = $request->selling_price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->features = $request->features;

        //Xử lý giảm giá
        if($request->discount_price!=NULL && $request->percent==NULL){
            $product->discount_price = $request->discount_price;
        }else if($request->percent!=NULL && $request->discount_price==NULL){
            $product->percent = $request->percent;
            $percent=$request->selling_price*($request->percent/100);
            $product->discount_price = $request->selling_price - $percent;
        }else{
            toastr()->warning('Không thể giảm giá đồng thời hai mục');
            return redirect()->back();
        }

        // Xử lý upload 1 ảnh
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $product->image = uploadImage('products', $image);
        }
        $product->save();

        //Upload nhiều ảnh
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as  $key => $image) {
                $productImage = new Product_Image();
                $productImage->product_id = $product->id;
                $productImage->image_path = uploadImage('products', $image);
                $productImage->save();
            }
        }

        //Xử lý thêm danh mục
        if ($request->category_id) {
            foreach ($request->category_id as $value) {
                $product_category = new Product_Category();
                $product_category->product_id = $product->id;
                $product_category->category_id = $value;
                $product_category->save();
            }
        }

        //Xử lý thêm màu sắc
        if ($request->color_id) {
            foreach ($request->color_id as $value) {
                $color = new Product_Color();
                $color->product_id = $product->id;
                $color->color_id = $value;
                $color->save();
            }
        }

        if ($request->size_id) {
            foreach ($request->size_id as $value) {
                $size = new Product_Size();
                $size->product_id = $product->id;
                $size->size_id = $value;
                $size->save();
            }
        }
        toastr()->success('Thành công thêm mới sản phẩm');

        return redirect()->back();
    }
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', [
            'title' => 'Cập nhật sản phẩm',
            'product' => $product,
            'data' => Category::orderBy('parent_id', 'asc')->get(),
            'size' => Size::all(),
            'color' => Color::all(),
            'images' => Product_Image::where('product_id', $id)->get(),
            'product_category' => Product_Category::where('product_id', $id)->get(),
            'product_color' => Product_Color::where('product_id', $id)->get(),
            'product_size' => Product_Size::where('product_id', $id)->get(),
        ]);
    }
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->brand = $request->brand;
        $product->selling_price = $request->selling_price;
        // $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
        $product->status = $request->status;
        $product->features = $request->features;

        //Xử lý giảm giá
        if($request->discount_price!=NULL && $request->percent==NULL){
            $product->discount_price = $request->discount_price;
        }else if($request->percent!=NULL && $request->discount_price==NULL){
            $product->percent = $request->percent;
            $percent=$request->selling_price*($request->percent/100);
            $product->discount_price = $request->selling_price - $percent;
        }else{
            toastr()->warning('Không thể giảm giá đồng thời hai mục');
            return redirect()->back();
        }

        // Xử lý update 1 ảnh
        if ($request->hasFile('image')) {
            $removeImg = Storage::delete('public/' . $product->image);
            if ($removeImg) {
                $image = $request->file('image');
                $product->image = uploadImage('products', $image);
            } else {
                $product->image = $product->image;
            }
        }
        $product->save();

        //Update nhiều ảnh
        if ($request->hasFile('images')) {
            // Xoá các ảnh cũ
            foreach ($product->productImages as $image) {
                Storage::delete('public/' . $image->image_path);
                $image->delete();
            }
            foreach ($request->file('images') as $key => $image) {
                $productImage = new Product_Image();
                $productImage->product_id = $product->id;
                $productImage->image_path = uploadImage('products', $image);
                $productImage->save();
            }
        }


        //Xử lý update danh mucj
        $product->categories()->detach();
        if ($request->category_id) {
            foreach ($request->category_id as $value) {
                $product_category = new Product_Category();
                $product_category->product_id = $product->id;
                $product_category->category_id = $value;
                $product_category->save();
            }
        }

        //Xử lý update màu sắc
        $product->colors()->detach();
        if ($request->color_id) {
            foreach ($request->color_id as $value) {
                $color = new Product_Color();
                $color->product_id = $product->id;
                $color->color_id = $value;
                $color->save();
            }
        }
        // xử lý update kích thước
        $product->sizes()->detach();
        if ($request->size_id) {
            foreach ($request->size_id as $value) {
                $size = new Product_Size();
                $size->product_id = $product->id;
                $size->size_id = $value;
                $size->save();
            }
        }
        // Alert::success('Thành công', 'Thành công cập nhật sản phẩm');
        toastr()->success('Thành công cập nhật sản phẩm');
        return redirect()->back();
    }
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $resultImg = Storage::delete('/public/' . $product->image);
        $product->delete();
        toastr()->success('Thành công xoá sản phẩm');
        // Alert::success('Thành công', 'Thành công xoá sản phẩm');
        return redirect()->back();
    }

    // public function show($id)
    // {
    //     $product = Product::findOrFail($id);
    //     return view('admin.products.show', [
    //         'title' => 'Chi tiết sản phẩm',
    //         'product' => $product,
    //         'category' => Category::all()
    //     ]);
    // }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            Product::whereIn('id', $ids)->delete();
            toastr()->success('Thành công xóa các sản phẩm đã chọn');
            // Alert::success('Thành công', 'Thành công xóa các sản phẩm đã chọn');
        } else {
            toastr()->warning('Không tìm thấy các sản phẩm đã chọn');
            // Alert::warning('Thất bại', 'Không tìm thấy các sản phẩm đã chọn');
        }
        return redirect()->back();
    }

    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        return view('admin.products.trash', [
            'title' => 'Thùng rác',
            'products' => $products
        ]);
    }
    public function permanentlyDelete($id)
    {
        $products = Product::withTrashed()->findOrFail($id);
        $products->forceDelete();
        toastr()->success('Thành công xoá vĩnh viễn sản phẩm');

        // Alert::success('Thành công', 'Thành công xoá vĩnh viễn sản phẩm');
        return redirect()->back();
    }
    public function restore(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            $product = Product::withTrashed()->whereIn('id', $ids);
            $product->restore();
            toastr()->success('Thành công khôi phục sản phẩm');

            // Alert::success('Thành công', 'Thành công khôi phục sản phẩm');
        } else {
            toastr()->warning('Không tìm thấy các sản phẩm đã chọn');

            // Alert::warning('Thất bại', 'Không tìm thấy các sản phẩm đã chọn');
        }
        return redirect()->back();
    }
}
