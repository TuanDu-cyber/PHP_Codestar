<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    // Chỉ người viết mới được xóa bình luận của mình
    public function delete(User $user, Comment $comment): bool
    {
        return (int) $user->id === (int) $comment->user_id;
    }
}
