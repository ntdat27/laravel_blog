<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController; // <--- Đừng quên dòng này

// 1. TRANG CHỦ (Danh sách bài viết)
Route::get('/', [PostController::class, 'index'])->name('home');

// 2. XEM CHI TIẾT BÀI VIẾT
Route::get('/baiviet/{id}', [PostController::class, 'show'])->name('posts.show');

// 3. GỬI COMMENT
Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');

// --- KHU VỰC AUTH (Đăng nhập/Đăng ký) ---

// Đăng ký
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'registerWeb']);

// Đăng nhập (Quan trọng: Phải có ->name('login') thì lỗi kia mới hết)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginWeb']);

// Đăng xuất
Route::post('/logout', [AuthController::class, 'logoutWeb'])->name('logout');

// Fix lỗi favicon (nếu có)
Route::get('/favicon.ico', function () {
    return response()->noContent();
});