<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\Auth\FacebookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [BlogController::class, 'index'])->name('welcome');
Route::get('blogs/{id}', [BlogController::class, 'show'])->name('viewBlog');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//routes for google redirect
Route::get('auth/google', [GoogleController::class,'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

//routes for facebook redirect
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);

//admin routes
Route::group(['prefix' => 'admin/', 'middleware' => ['role:administrator']], function(){
    # code...
    Route::get('dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('adminDashboard');
    Route::get('dashboard/ablog/{id}', [AdminController::class, 'show'])->name('adminShowBlog');
    Route::post('dashboard/blog/approveBlog/{id}', [AdminController::class, 'approveBlog'])->name('approveBlog');
    Route::post('dashboard/blog/pendBlog/{id}', [AdminController::class, 'pendBlog'])->name('pendBlog');
    Route::post('dashboard/blog/declineBlog/{id}', [AdminController::class, 'declineBlog'])->name('declineBlog');
});


//user routes
Route::group(['prefix' => 'user/', 'middleware' => ['role:user']], function(){
    # code...
    Route::get('dashboard', [UserController::class, 'dashboard'])->name('userDashboard');
    Route::get('dashboard/blogs/myIndex', [UserController::class, 'index'])->name('indexBlog');
    Route::get('dashboard/blogs/create', [UserController::class, 'create'])->name('createBlog');
    Route::post('dashboard/blogs/store', [UserController::class, 'store'])->name('storeBlog');
    Route::get('dashboard/blog/{id}', [UserController::class, 'show'])->name('showBlog');
    Route::get('dashboard/blogs/edit/{id}', [UserController::class, 'edit'])->name('editBlog');
    Route::post('dashboard/blogs/update/{id}', [UserController::class, 'update'])->name('updateBlog');
    Route::get('dashboard/blogs/destroy/{id}', [UserController::class, 'destroy'])->name('destroyBlog');
});
