<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePost;
use App\Http\Requests\UpdatePost;
use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //Danh sách bài viết của t ko gồm bài trong thùng rác
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())
            ->orderBy('published_at', 'desc')
            ->get();

        $trashedCount = Post::onlyTrashed()->where('user_id', Auth::id())->count();

        return view('posts.index', [
            'posts'        => $posts,
            'categories'   => Post::CATEGORIES,
            'trashedCount' => $trashedCount,
        ]);
    }

    public function create()
    {
        return view('posts.create', ['categories' => Post::CATEGORIES]);
    }

    public function store(StorePost $request)
    {
        // user_id tự gắn theo người đăng nhập, không lấy từ form
        $request->user()->posts()->create([
            'title'        => $request->title,
            'category'     => $request->category,
            'content'      => $request->content,
            'image'        => $this->uploadImage($request->file('image_file')),
            'published_at' => now(),
        ]);

        return redirect()->route('post.index')->with('success', 'Đã đăng bài viết mới.');
    }

    public function edit(Post $post)
    {
        Gate::authorize('update', $post); // không phải chủ bài -> 403

        return view('posts.edit', [
            'post'       => $post,
            'categories' => Post::CATEGORIES,
        ]);
    }

    public function update(UpdatePost $request, Post $post)
    {
        //Quyền sở hữu đã được kiểm tra trong UpdatePost::authorize()
        $data = [
            'title'    => $request->title,
            'category' => $request->category,
            'content'  => $request->content,
        ];

        // Chỉ khi chọn ảnh mới thì mới thay ảnh cũ
        if ($request->hasFile('image_file')) {
            $this->deleteImage($post->image);
            $data['image'] = $this->uploadImage($request->file('image_file'));
        }

        $post->update($data);

        return redirect()->route('post.index')->with('success', 'Đã cập nhật bài viết.');
    }

    // XÓA MỀM: chỉ đánh dấu deleted_at, giữ nguyên ảnh để còn khôi phục
    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return redirect()->route('post.index')->with('success', 'Đã chuyển bài viết vào thùng rác.');
    }

    // Thùng rác của tôi
    public function trash()
    {
        $posts = Post::onlyTrashed()
            ->where('user_id', Auth::id())
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('posts.trash', ['posts' => $posts]);
    }

    // Khôi phục bài viết từ thùng rác
    public function restore(Post $post)
    {
        Gate::authorize('restore', $post);

        $post->restore();

        return redirect()->route('post.trash')->with('success', 'Đã khôi phục bài viết.');
    }

    // Xóa vĩnh viễn: lúc này mới xóa dòng trong DB và file ảnh
    public function forceDelete(Post $post)
    {
        Gate::authorize('forceDelete', $post);

        $this->deleteImage($post->image);
        $post->forceDelete();

        return redirect()->route('post.trash')->with('success', 'Đã xóa vĩnh viễn bài viết.');
    }

    // Lưu ảnh vào public/upload, trả về đường dẫn để lưu DB
    private function uploadImage(UploadedFile $file): string
    {
        // tên ngẫu nhiên + đuôi lấy theo nội dung file thật
        $fileName = $file->hashName(); 
        $file->move(public_path('upload'), $fileName);

        return 'upload/' . $fileName;
    }

    // Chỉ xóa ảnh do người dùng upload, không đụng ảnh mẫu trong images/
    private function deleteImage(?string $path): void
    {
        if ($path && str_starts_with($path, 'upload/')) {
            File::delete(public_path($path));
        }
    }
}
