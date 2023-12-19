<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Barta\AppController;
use App\Http\Controllers\Barta\PostController;
use App\Http\Controllers\Barta\CommentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('guest')->group(function () {
    //User Authentication Page
    Route::get('/login', [LoginController::class, 'login_page'])->name('login');
    Route::get('/register', [RegistrationController::class, 'register_page'])->name('register');

    //User Manual Authentication
    Route::post('/create-user', [RegistrationController::class, 'create_user'])->name('create-user');
    Route::post('/user-login', [LoginController::class, 'user_login'])->name('user-login');

    //Google Authentication
    Route::get('/login/google', [LoginController::class, 'googleRedirect']);
    Route::get('/login/google/callback', [LoginController::class, 'loginWithGoogle']);
});


Route::middleware('auth')->group(function () {
    Route::get('/', [AppController::class, 'barta_app'])->name('barta-app');
    Route::get('/barta-detail/{id}', [AppController::class, 'barta_detail'])->name('barta-detail');
    Route::get('/get-all-barta', [AppController::class, 'get_all_barta'])->name('get-all-barta');
    Route::post('/barta-post', [PostController::class, 'barta_post'])->name('barta-post');
    Route::delete('/barta-delete/{id}', [PostController::class, 'barta_delete'])->name('barta-delete');
    Route::post('/comment-post', [CommentController::class, 'comment_post'])->name('comment-post');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});
