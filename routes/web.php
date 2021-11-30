<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard',[AdminController::class,'dashboard_page_view'])->middleware('AdminCheck');
Route::get('/login',[AdminController::class,'login_page_view']);
Route::get('logout',[AdminController::class,'logOut']);
Route::post('api-on-login',[AdminController::class,'onLogin']);
// Student Registration.
Route::get('registration',[RegisterController::class,'RegistrationPageView']);
Route::post('api-student-registration',[RegisterController::class,'onRegistration']);
Route::post('api-student-registration-otp-confirm',[RegisterController::class,'confirmRegisterOtp']);
// Check Status
Route::get('check-status',[FrontController::class,'PageCheckStatus']);
Route::post('api-check-status',[FrontController::class,'checkStatusFromID']);

// Download
Route::get('download-certificate',[FrontController::class,'PageDownload']);
Route::get('/',[FrontController::class,'PageHome']);
