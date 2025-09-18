<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\uploadData;
use Illuminate\Support\Facades\Route;


Route::get('/', [registerController::class, 'register'])->name('register');
Route::post('/register/save', [registerController::class, 'registerSave'])->name('register.save');

Route::get('/login', [loginController::class, 'login'])->name('login');
Route::post('/login/user', [loginController::class, 'userlogin'])->name('user.login');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'dashboardPage'])->name('dashboard');
    Route::post('/logout', [loginController::class, 'logout'])->name('logout');
    Route::get('/uploadData', [uploadData::class, 'viewUploadDataForm'])->name('uploadData');
});

