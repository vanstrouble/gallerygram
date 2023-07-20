<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('principal');
});

Route::view('/', 'principal')->name('principal');

Route::get('/sign', [RegisterController::class,'index'])->name('sign');
Route::post('/sign', [RegisterController::class,'store'])->name('sign');

Route::get('/login', [LoginController::class,'index'])->name('login');
Route::post('/login', [LoginController::class,'store'])->name('login');
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('{user:username}/edit-profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('{user:username}/edit-profile', [ProfileController::class, 'store'])->name('profile.store');

Route::get('/{user:username}', [PostController::class,'index'])->name('dash.index');
Route::get('/post/create', [PostController::class, 'create'])->name('dash.create');

Route::post('/posts', [PostController::class, 'store'])->name('post.store');
Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])->name('posts.show');

Route::post('/{user:username}/posts/{post}', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

Route::post('/images', [ImageController::class, 'store'])->name('image.store');

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');
Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

Route::get('{user:username}/edit-profile', [ProfileController::class, 'index'])->name('profile.index');
Route::post('{user:username}/edit-profile', [ProfileController::class, 'store'])->name('profile.store');
