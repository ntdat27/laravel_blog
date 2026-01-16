<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);
        $request->validate([
            'content' => 'required|string|max:100000',
            'guest_name' => 'nullable|string|max:50',
        ]);
        $data = [
            'post_id' => $post->id,
            'content' => $request->input('content'),
        ];
        if (Auth::check()) {
            $data['user_id'] = Auth::id;
        } else {
            $data['session_id'] = session()->getId();
            $data['guest_name'] = $request->input("guest_name", 'An danh');
        }
        Comment::create($data);
        return back()->with('success', 'Binh Luon Thanh cong');

    }


}
