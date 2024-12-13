<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

// Hiển thị danh sách bài viết
Route::get('/', [PostController::class, 'index'])->name('posts.index');

// Hiển thị form thêm bài viết
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// Lưu bài viết
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// Hiển thị chi tiết bài viết
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// Hiển thị form chỉnh sửa bài viết
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

// Cập nhật bài viết
Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

// Xóa bài viết
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
