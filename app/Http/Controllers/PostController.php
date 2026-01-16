<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy tất cả bài viết, bài mới nhất lên đầu
        // Nếu muốn hiển thị tên tác giả thì thêm with('user')
        $posts = Post::with('user')->latest()->get();

        // Trả về view 'welcome' kèm theo gói hàng 'posts'
        return view('welcome', compact('posts'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = \App\Models\Post::with("comments.user")->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
