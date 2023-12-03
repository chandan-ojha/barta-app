<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BartaController;

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

//User Authentication Page
Route::get('/login', [LoginController::class, 'login_page'])->name('login');
Route::get('/register', [RegistrationController::class, 'register_page'])->name('register');

//User Authentication
Route::post('/create-user', [RegistrationController::class, 'create_user'])->name('create-user');
Route::post('/user-login', [LoginController::class, 'user_login'])->name('user-login');


Route::middleware('auth')->group(function () {
    Route::get('/', [BartaController::class, 'barta_app'])->name('barta-app');
    Route::get('/barta-detail/{id}', [BartaController::class, 'barta_detail'])->name('barta-detail');
    Route::get('/get-all-barta', [BartaController::class, 'get_all_barta'])->name('get-all-barta');
    Route::post('/barta-post', [BartaController::class, 'barta_post'])->name('barta-post');
    Route::post('/comment-post', [BartaController::class, 'comment_post'])->name('comment-post');
});
