<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/',[AdminController::class,'dashboard_page_view'])->middleware('AdminCheck');
Route::get('/login',[AdminController::class,'login_page_view']);
Route::get('logout',[AdminController::class,'logOut']);
Route::post('api-on-login',[AdminController::class,'onLogin']);