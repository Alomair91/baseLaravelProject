<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Postman Collection: https://www.getpostman.com/collections/cd8e305529c54e6b4835

// user
Route::resource('user', \App\Http\modules\user\controller\UserController::class);
Route::controller(\App\Http\modules\user\controller\UserController::class)->group(function () {
    Route::post('register', 'store')->name('register');
    Route::post('login', 'login')->name('login');
    Route::middleware('auth:sanctum')->post('logout', 'logout')->name('logout');
});

// product
Route::resource('category', \App\Http\modules\products\controller\CategoryController::class);
Route::resource('brand', \App\Http\modules\products\controller\BrandController::class);
Route::resource('product', \App\Http\modules\products\controller\ProductController::class);
