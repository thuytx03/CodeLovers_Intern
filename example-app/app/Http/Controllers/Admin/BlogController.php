<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Blog_Type;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        return view('admin.blogs.index', [
            'title' => 'Quản lý bài viết',
            'data' => Blog::paginate(5)
        ]);
    }
    public function create()
    {
        return view('admin.blogs.add', [
            'title' => 'Trang thêm mới bài viết',
            'data' => Type::orderBy('parent_id', 'asc')->get()
        ]);
    }
    public function store(Request $request)
    {
        $user = auth()->user();

        $blogs = new Blog();
        $blogs->name = $request->name;
        $blogs->slug = Str::slug($request->name);
        $blogs->content = $request->content;
        $blogs->status = $request->status;
        $blogs->user_id = $user->id;

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $blogs->cover_image = uploadImage('blogs', $image);
        }

        $blogs->save();

        foreach ($request->type_id as $type_id) {
            $blog_types = new Blog_Type();
            $blog_types->type_id = $type_id;
            $blog_types->blog_id = $blogs->id;
            $blog_types->save();
        }

        toastr()->success('Thành công thêm mới bài viết');
        return redirect()->back();
    }
    public function edit($id)
    {
        $blogs = Blog::find($id);

        return view('admin.blogs.edit', [
            'title' => 'Trang chỉnh sửa bài viết',
            'data' => $blogs,
            'type' => Type::orderBy('parent_id', 'asc')->get(),
            'blog_type' => Blog_Type::where('blog_id', $id)->get()
        ]);
    }
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $blogs = Blog::find($id);

        $blogs->name = $request->name;
        $blogs->slug = Str::slug($request->slug);
        $blogs->content = $request->content;
        $blogs->status = $request->status;
        $blogs->user_id = $user->id;

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $blogs->cover_image = uploadImage('blogs', $image);
        }

        $blogs->save();

        // Xóa các blog_types cũ của bài viết
        Blog_Type::where('blog_id', $blogs->id)->delete();

        // Thêm mới các blog_types đã chọn
        if ($request->has('type_id')) {
            foreach ($request->type_id as $category_id) {
                $blog_types = new Blog_Type();
                $blog_types->type_id = $category_id;
                $blog_types->blog_id = $blogs->id;
                $blog_types->save();
            }
        }

        // Thông báo thành công
        toastr()->success('Thành công chỉnh sửa bài viết');

        return redirect()->back();
    }

    public function destroy($id)
    {
        $data = Blog::find($id);
        $resultImg = Storage::delete('/public/' . $data->image);
        $data->delete();
        toastr()->success('Thành công xoá bài viết');
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            Blog::whereIn('id', $ids)->delete();
            toastr()->success('Thành công xóa các bài viết đã chọn');
        } else {
            toastr()->warning('Không tìm thấy các bài viết đã chọn');
        }

        return redirect()->route('list.blogs');
    }

    public function trash()
    {
        $blogs = Blog::onlyTrashed()->get();
        return view('admin.blogs.trash', [
            'title' => 'Thùng rác',
            'blogs' => $blogs
        ]);
    }
    public function permanentlyDelete($id)
    {
        $blogs = Blog::withTrashed()->findOrFail($id);
        $blogs->forceDelete();
        toastr()->success('Thành công xoá vĩnh viễn bài viết');
        return redirect()->route('trash.blogs');
    }
    public function restore(Request $request)
    {
        $ids = $request->ids;
        if ($ids) {
            $blog = Blog::withTrashed()->whereIn('id', $ids);
            $blog->restore();
            toastr()->success('Thành công khôi phục bài viết');
        } else {
            toastr()->warning('Không tìm thấy các bài viết đã chọn');
        }
        return redirect()->route('trash.blogs');
    }

    public function cleanupTrash()
    {
        $thirtyDaysAgo = Carbon::now()->subDays(1);
        Blog::onlyTrashed()->where('deleted_at', '<', $thirtyDaysAgo)->forceDelete();
        return redirect()->route('list.blogs')->withSuccess('Đã xoá vĩnh viễn các bài viết trong thùng rác');
    }
}
