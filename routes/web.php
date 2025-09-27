<?php

use App\Http\Controllers\dashboardController;
use App\Http\Controllers\dataExportController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\uploadDataController;
use App\Http\Controllers\userController;
use App\Http\Controllers\verifyOtpController;
use Illuminate\Support\Facades\Route;


Route::get('/', [registerController::class, 'register'])->name('register');
Route::post('/register/save', [registerController::class, 'registerSave'])->name('register.save');

Route::get('/verify-otp/{email}/{formName}', [verifyOtpController::class, 'showVerifyPage'])->name('verify.otp');
Route::post('/verify-otp', [VerifyOtpController::class, 'verifyOtp'])->name('verify.otp.post');
Route::get('/resend-otp/{email}', [VerifyOtpController::class, 'resendOtp'])->name('resend.otp');


Route::get('/login', [loginController::class, 'login'])->name('login');
Route::post('/login/user', [loginController::class, 'userlogin'])->name('user.login');

Route::get('/reset-password', [loginController::class, 'showResetPassword'])->name('reset.password');
Route::post('/reset-password/send-otp', [loginController::class, 'resetPasswordSendOtp'])->name('reset.password.send.otp');

Route::get('/reset-new-password/{email}', [loginController::class, 'resetNewPassword'])->name('reset.new.password');
Route::post('/update-new-password', [loginController::class, 'updateNewPassword'])->name('update.new.password');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [dashboardController::class, 'dashboardPage'])->name('dashboard');
    Route::post('/logout', [loginController::class, 'logout'])->name('logout');
    Route::get('/all-user', [userController::class, 'viewAllUser'])->name('all.user');
    Route::get('/uploadData', [uploadDataController::class, 'viewUploadDataForm'])->name('uploadData');
    Route::post('/importExcelData', [uploadDataController::class, 'importExcelData'])->name('importExcelData');
    Route::get('/show-form-data', [uploadDataController::class, 'viewAllUploadData'])->name('show.form.data');
    Route::get('/download-master-sheet', [dataExportController::class, 'viewDateRange'])->name('view.daterange');
    Route::post('/export/daterange', [dataExportController::class, 'exportDateRange'])->name('export.daterange');
});

