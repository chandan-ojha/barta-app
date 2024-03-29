<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Profile\ProfileController;
use App\Http\Controllers\Barta\AppController;
use App\Http\Controllers\Barta\PostController;
use App\Http\Controllers\Barta\PostLikesController;
use App\Http\Controllers\Barta\CommentController;
use App\Http\Controllers\Profile\FollowsController;
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
    /* Barta App */
    Route::get('/', [AppController::class, 'barta_app'])->name('barta-app');
    Route::get('/barta-detail/{id}', [AppController::class, 'barta_detail'])->name('barta-detail');

    /* Posts */
    Route::post('/barta-post', [PostController::class, 'barta_post'])->name('barta-post');
    Route::delete('/barta-delete/{id}', [PostController::class, 'barta_delete'])->name('barta-delete');

    /* Likes */
    Route::post('posts/{post}/like', [PostLikesController::class, 'store']);
    Route::delete('posts/{post}/like', [PostLikesController::class, 'destroy']);

    /* Comments */
    Route::post('/comment-post', [CommentController::class, 'comment_post'])->name('comment-post');
    Route::delete('/comment-delete/{id}', [CommentController::class, 'comment_delete'])->name('comment-delete');

    /* User Profile */
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile-edit');
    Route::post('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile-update');

    /* User Follow */
    Route::post('/profile/{user:id}/follow', [FollowsController::class, 'store'])->name('follow');

    /* User Logout */
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
});
