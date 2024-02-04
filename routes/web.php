<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Barta\AppController;
use App\Http\Controllers\Barta\PostController;
use App\Http\Controllers\Barta\PostLikesController;
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
    /* User Profile */
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile-edit');

    /* Barta Post */
    Route::get('/', [AppController::class, 'barta_app'])->name('barta-app');
    Route::get('/barta-detail/{id}', [AppController::class, 'barta_detail'])->name('barta-detail');
    Route::post('/barta-post', [PostController::class, 'barta_post'])->name('barta-post');
    Route::delete('/barta-delete/{id}', [PostController::class, 'barta_delete'])->name('barta-delete');

    /* Barta Post Likes */
    Route::post('posts/{post}/like', [PostLikesController::class, 'store']);
    Route::delete('posts/{post}/like', [PostLikesController::class, 'destroy']);

    /* Barta Post Comments */
    Route::post('/comment-post', [CommentController::class, 'comment_post'])->name('comment-post');
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    Route::delete('/comment-delete/{id}', [CommentController::class, 'comment_delete'])->name('comment-delete');
});
