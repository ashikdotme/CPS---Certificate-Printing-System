<?php

use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard',[AdminController::class,'dashboard_page_view'])->middleware('AdminCheck');
Route::get('/login',[AdminController::class,'login_page_view']);
Route::get('logout',[AdminController::class,'logOut']);
Route::post('api-on-login',[AdminController::class,'onLogin']);

// Dashboard 
Route::get('pending-certificate-request',[CertificateController::class,'PendingRequestPage'])->middleware('AdminCheck');
Route::get('reject-request-list',[CertificateController::class,'RejectListPage'])->middleware('AdminCheck');
Route::get('approved-request-list',[CertificateController::class,'ApprovedListPage'])->middleware('AdminCheck');
Route::get('request-details',[CertificateController::class,'RequestDetails'])->middleware('AdminCheck');
Route::get('api-pending-certificate-request-list',[CertificateController::class,'PendingRequestList'])->middleware('AdminCheck');
Route::get('api-reject-certificate-list',[CertificateController::class,'RejectRequestList'])->middleware('AdminCheck');
Route::get('api-approve-certificate-list',[CertificateController::class,'ApproveRequestList'])->middleware('AdminCheck');
Route::post('api-approve-pending-request',[CertificateController::class,'AdminApprove'])->middleware('AdminCheck');
Route::post('api-reject-pending-request',[CertificateController::class,'AdminReject'])->middleware('AdminCheck');


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
