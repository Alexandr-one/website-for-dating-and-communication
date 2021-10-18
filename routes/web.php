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
Route::get('/auth',[\App\Http\Controllers\AuthMainController::class, 'main'])->name('first');
Route::get('/registration',[\App\Http\Controllers\AuthMainController::class, 'registration'])->name('homepage');
Route::get('/index/chat/{id}',[\App\Http\Controllers\ChatModelController::class, 'index'])->name('chat.index')->middleware('auth:sanctum','check.status');
Route::get('/',[\App\Http\Controllers\AuthMainController::class, 'index'])->name('index')->middleware('auth:sanctum', 'check.status');
Route::get('/profile',[\App\Http\Controllers\ProfileController::class, 'index'])->name('profile')->middleware('auth:sanctum','check.status');
Route::get('/verification',[\App\Http\Controllers\AuthMainController::class,'verification'])->name('verify')->middleware('auth:sanctum','new.status');
//---------------------------------------------------------------------------------------------------------------------------------------------------------------
Route::post('/send',[\App\Http\Controllers\AuthMainController::class,'send'])->name('send');
Route::post('/send/token/',[\App\Http\Controllers\AuthMainController::class,'sendToken'])->name('sendToken');
Route::get('/send/mess/',[\App\Http\Controllers\AuthMainController::class,'sendMessToEmail'])->name('sendMessToEmail');
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[\App\Http\Controllers\AuthMainController::class, 'logout'])->name('logout');
    Route::post('/change',[\App\Http\Controllers\ProfileController::class, 'change'])->name('change');
    Route::post('/index/chat/post',[\App\Http\Controllers\ChatModelController::class, 'postImage'])->name('chat.post');
    Route::post('/change_mess',[\App\Http\Controllers\ChatModelController::class, 'changeMess'])->name('changeMess');
});

Route::middleware('admin.status')->group(function(){
    Route::get('/admin',[App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/admin/users',[App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/admin/chats',[App\Http\Controllers\AdminController::class, 'chats'])->name('chats');
    Route::get('/admin/smiles',[App\Http\Controllers\AdminController::class, 'smiles'])->name('smiles');
    Route::get('/admin/messages',[App\Http\Controllers\AdminController::class, 'messages'])->name('messages');
    Route::get('/admin/likes',[App\Http\Controllers\AdminController::class, 'likes'])->name('likes');
    Route::post('/admin/smiles/add',[\App\Http\Controllers\AdminController::class,'addSmile'])->name('addSmile');
    Route::post('/admin/smiles/delete',[\App\Http\Controllers\AdminController::class,'deleteSmile'])->name('deleteSmile');
});
