<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Cart;
use App\Models\Logo;
use Illuminate\Http\Request;

class BlogClientController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = NULL;
        }

        $selectedCategoryId = $request->input('category');

        $blogQuery = Blog::query();
        if ($selectedCategoryId) {
            $blogQuery->whereHas('types', function ($query) use ($selectedCategoryId) {
                $query->where('type_id', $selectedCategoryId);
            });
        }

        $data = $blogQuery->paginate(8);
        $timeAgo = [];
        foreach ($data as $value) {
            $timeAgo[$value->id] = $value->created_at->diffForHumans();
        }
        return view('client.blog.blog', [
            'title' => 'Bài viết',
            'logo' => Logo::find(1),
            'countCart' => $countCart,
            'data' => $data,
            'timeAgo' => $timeAgo
        ]);
    }
    public function detail($slug, $id)
    {
        $user = auth()->user();
        if ($user) {
            $countCart = Cart::where('user_id', $user->id)->count();
        } else {
            $countCart = NULL;
        }
        $blogs = Blog::where('slug', $slug)->where('id', $id)->first();

        return view(
            'client.blog.detail',
            [
                'title' => 'Chi tiết tin tức',
                'blogs' => $blogs,
                'logo' => Logo::find(1),
                'countCart' => $countCart,

            ]
        );
    }
}
