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
Route::post('/login',[\App\Http\Controllers\AuthApiController::class, 'login'])->name('auth.login');
Route::post('/register',[\App\Http\Controllers\AuthApiController::class, 'register'])->name('auth.register');
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    echo Auth::user();
});
Route::get('/like/{user_id}/{id}', [\App\Http\Controllers\Api\User\UserController::class, 'like'])->name('users.like');
Route::get('/delike/{user_id}/{id}', [\App\Http\Controllers\Api\User\UserController::class, 'delike'])->name('users.delike');
Route::get('/users/{id}', [\App\Http\Controllers\Api\User\UserController::class, 'show'])->name('users.show');
Route::get('/image/{id}', [\App\Http\Controllers\ChatModelController::class, 'image'])->name('users.image');
Route::get('/message/{id}', [\App\Http\Controllers\ChatModelController::class, 'message'])->name('users.image');
Route::post('/index/create/chat',[\App\Http\Controllers\ChatModelController::class,'createChat'])->name('create.chat');
Route::post('/messages',[\App\Http\Controllers\ChatModelController::class, 'postMessage']);
Route::post('/delete_mess/{id}',[\App\Http\Controllers\ChatModelController::class, 'deleteMessage']);
