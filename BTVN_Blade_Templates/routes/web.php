<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

//Công khai
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article/{post}', [HomeController::class, 'show'])->name('article.show');

//Chỉ dành cho khách chưa đăng nhập
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

//Chỉ dành cho người đã đăng nhập
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Bài viết của tôi
    Route::get('/post', [PostController::class, 'index'])->name('post.index');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    //Thùng rác xóa mềm. withTrashed() để tìm được cả bài đã bị xóa mềm
    Route::get('/trash', [PostController::class, 'trash'])->name('post.trash');
    Route::patch('/post/{post}/restore', [PostController::class, 'restore'])
        ->name('post.restore')
        ->withTrashed();
    Route::delete('/post/{post}/force-delete', [PostController::class, 'forceDelete'])
        ->name('post.force-delete')
        ->withTrashed();

    //Bình luận
    Route::post('/article/{post}/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');
});
