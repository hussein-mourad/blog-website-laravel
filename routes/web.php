<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
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

Route::resource('posts', PostController::class);

Route::get('/', [PostController::class, 'index']);
Route::get('/posts/{post}', [PostController::class, 'show'])->whereNumber('id');

Route::get('/posts/create', [PostController::class, 'create'])->middleware('auth');
Route::post('/posts', [PostController::class, 'store']);

// User Routes
Route::view('/login', 'users.login')->middleware('guest');
Route::view('/signup', 'users.signup')->middleware('guest');
Route::post('/users', [UserController::class, "store"]);
Route::post('/users/auth', [UserController::class, "auth"])->middleware('guest');
Route::post('/logout', [UserController::class, "logout"])->middleware('auth');
