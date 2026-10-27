<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreComment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(StoreComment $request, Post $post)
    {
        Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),   // lấy theo người đăng nhập, không lấy từ form
            'content' => $request->content,
        ]);

        return redirect(route('article.show', $post) . '#comments')
            ->with('success', 'Đã gửi bình luận.');
    }

    public function destroy(Comment $comment)
    {
        Gate::authorize('delete', $comment); // ko phải chủ bình luận -> 403

        $comment->delete();

        return back()->with('success', 'Đã xóa bình luận.');
    }
}
