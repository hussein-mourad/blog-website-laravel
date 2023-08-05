<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\UserController;

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

// index
// show
// create
// store
// edit
// update
// destroy

Route::get('/', [PostController::class, 'index']);
Route::get('/dashboard', [UserController::class, 'dashboard']);
Route::resource('posts', PostController::class)
  ->only(['create', 'store', 'edit', 'update', 'destroy'])
  ->middleware('auth');
Route::get('/posts/{post}', [PostController::class, 'show'])->whereNumber('id');

Route::post('/comments/{post}', [CommentController::class, 'store'])->middleware('auth');
Route::resource('comments', CommentController::class)
  ->only(['update', 'destroy'])
  ->middleware('auth');

Route::post('/reactions/{post}', [ReactionController::class, 'store'])->middleware('auth');
Route::resource('reactions', ReactionController::class)
  ->only(['update', 'destroy'])
  ->middleware('auth');
// Route::get('/posts/{post}', [PostController::class, 'show'])->whereNumber('id');

// User Routes
Route::view('/login', 'users.login')->middleware('guest')->name('login');
Route::view('/signup', 'users.signup')->middleware('guest')->name('signup');
Route::post('/users', [UserController::class, "store"])->name('users.store');
Route::post('/users/auth', [UserController::class, "auth"])->middleware('guest');
Route::post('/logout', [UserController::class, "logout"])->middleware('auth');
Route::delete('/users/{user}', [UserController::class, "destroy"])->name('users.delete')->middleware('auth');
