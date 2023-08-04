<?php

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

Route::get('/', function () {
    return view('posts.index');
});


// Auth Routes
Route::view('/login', 'users.login');
Route::view('/signup', 'users.signup');
