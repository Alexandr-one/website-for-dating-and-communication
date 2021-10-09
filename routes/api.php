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
Route::post('/login',[\App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('/register',[\App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    echo Auth::user();
});
Route::group(['middleware'=>'auth:sanctum'], function() {
    Route::get('/products',[\App\Http\Controllers\ProductController::class, 'index'])->name('api.products');
    Route::post('/add/product',[\App\Http\Controllers\ProductController::class, 'add'])->name('api.add.product');
});
Route::get('/like/{user_id}/{id}', [\App\Http\Controllers\Api\User\UserController::class, 'like'])->name('users.like');
Route::get('/delike/{user_id}/{id}', [\App\Http\Controllers\Api\User\UserController::class, 'delike'])->name('users.delike');
Route::get('/users/{id}', [\App\Http\Controllers\Api\User\UserController::class, 'show'])->name('users.show');
Route::get('/image/{id}', [\App\Http\Controllers\Api\User\UserController::class, 'image'])->name('users.image');
Route::post('/messages',[\App\Http\Controllers\Api\User\UserController::class, 'postMessage']);
Route::post('/index/create/chat',[\App\Http\Controllers\ChatModelController::class,'createChat'])->name('create.chat');
