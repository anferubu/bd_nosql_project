<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', HomeController::class)->name('home');

Route::controller(SignupController::class)
  ->group(function() {
      Route::get('/signup', 'index')->name('signup');
      Route::post('/signup', 'store');
});

Route::controller(LoginController::class)
  ->group(function() {
      Route::get('/login', 'index')->name('login');
      Route::post('/login', 'store');
});

Route::post('/logout', [LogoutController::class, 'store'])
  ->name('logout');

Route::get('/edit-profile', [ProfileController::class, 'index'])->name('profile.index');

Route::post('/edit-profile', [ProfileController::class, 'store'])->name('profile.store');

Route::get('/{user:username}', [PostController::class, 'index'])
  ->name('posts.index');

Route::get('/posts/create', [PostController::class, 'create'])
  ->name('posts.create');

Route::post('/posts', [PostController::class, 'store'])
  ->name('posts.store');

Route::get('/{user:username}/posts/{post}', [PostController::class, 'show'])
  ->name('posts.show');

Route::post('/{user:username}/posts/{post}', [CommentController::class, 'store'])
  ->name('comments.store');

Route::delete('/posts/{post}', [PostController::class, 'destroy'])
  ->name('posts.destroy');

Route::post('/images', [ImageController::class, 'store'])
  ->name('images.store');

Route::post('/posts/{post}/likes', [LikeController::class, 'store'])->name('posts.likes.store');

Route::delete('/posts/{post}/likes', [LikeController::class, 'destroy'])->name('posts.likes.destroy');

Route::post('/{user:username}/follow', [FollowerController::class, 'store'])->name('users.follow');

Route::delete('/{user:username}/unfollow', [FollowerController::class, 'destroy'])->name('users.unfollow');