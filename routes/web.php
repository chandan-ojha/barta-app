<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

//
Route::middleware('auth')->group(function(){

});

//User Authentication Page
Route::get('/login', [AuthController::class, 'login_page'])->name('login');
Route::get('/register', [AuthController::class, 'register_page'])->name('register');

//User Authentication
Route::post('/create-user', [AuthController::class, 'create_user'])->name('create-user');
Route::post('/user-login', [AuthController::class, 'user_login'])->name('user-login');


//Barta
Route::get('/', [BartaController::class, 'barta_app'])->name('barta-app');
Route::get('/barta-detail/{id}', [BartaController::class, 'barta_detail'])->name('barta-detail');
Route::get('/get-all-barta', [BartaController::class, 'get_all_barta'])->name('get-all-barta');
Route::post('/barta-post', [BartaController::class, 'barta_post'])->name('barta-post');
Route::post('/comment-post', [BartaController::class, 'comment_post'])->name('comment-post');
