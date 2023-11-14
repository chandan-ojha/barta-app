<?php

use Illuminate\Support\Facades\Route;
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

Route::get('/', [BartaController::class, 'barta_app'])->name('barta-app');
Route::get('/barta-detail', [BartaController::class, 'barta_detail'])->name('barta-detail');
