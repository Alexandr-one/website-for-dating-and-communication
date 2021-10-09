<?php

use Illuminate\Support\Facades\Route;

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
Route::post('/login',[\App\Http\Controllers\AuthMainController::class,'login'])->name('login');
Route::post('/register',[\App\Http\Controllers\AuthMainController::class,'register'])->name('register');
Route::post('/logout',[\App\Http\Controllers\AuthMainController::class, 'logout'])->name('logout')->middleware('auth:sanctum');
//------------------------------------------------------------------------------------------------------------------------------
Route::get('/',[\App\Http\Controllers\AuthMainController::class, 'main'])->name('homepage');
Route::get('/index',[\App\Http\Controllers\AuthMainController::class, 'index'])->name('index')->middleware('auth:sanctum');
Route::get('/profile',[\App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('auth:sanctum');
Route::post('/change',[\App\Http\Controllers\ProfileController::class, 'change'])->name('change')->middleware('auth:sanctum');
//----------------------------------------------------------------------------------------------------------
Route::get('/index/chat/{id}',[\App\Http\Controllers\ChatModelController::class, 'index'])->name('chat.index')->middleware('auth:sanctum');
Route::post('/index/chat/post',[\App\Http\Controllers\ChatModelController::class, 'postImage'])->name('chat.post')->middleware('auth:sanctum');
Route::get('send',[\App\Http\Controllers\AuthMainController::class,'send'])->name('send');
