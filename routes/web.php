<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TerminasiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DatappksController;
use App\Http\Controllers\SebaranController;
use App\Http\Controllers\authController;
use App\Http\Controllers\DashboardController;
;


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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::controller(authController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});


// Route::prefix('/dashboard')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/kriteria', KriteriaController::class);

    Route::resource('/users', UserController::class);

    Route::post('/user/reset-password', [userController::class, 'resetPasswordAdmin'])->name('user.password');

    Route::resource('/terminasi', TerminasiController::class);

    Route::resource('/datappks', DatappksController::class);

    Route::get('/sebaran', [SebaranController::class, 'index'])->name('sebaran');

// });

