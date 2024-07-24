<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TerminasiController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\DatappksController;
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
    return view('index');
});



// Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Route::get('/users/create', [UserController::class, 'create'])->name('users.create');

// Route::post('/users', [UserController::class, 'store'])->name('users.store');

// Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');

// Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');

// Route::patch('/users/{user}', [UserController::class, 'update']);

// Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

// Route::resource('/terminasi', TerminasiController::class);


// Route::put('/users/{user}', [UserController::class, 'resetpassword'])->name('users.resetpassword');

//
Route::resource('/kriteria', KriteriaController::class);

Route::resource('/users', UserController::class);

Route::post('/user/reset-password', [userController::class, 'resetPasswordAdmin'])->name('user.password');

Route::resource('/terminasi', TerminasiController::class);

Route::resource('/datappks', DatappksController::class);
