<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SchoolController;

Route::get('/',[AuthController::class,'login']);
Route::post('/',[AuthController::class,'auth_login']);
Route::get('forgot',[AuthController::class,'forgot']);
Route::get('logout',[AuthController::class,'logout']);


Route::group(['middleware' => 'common'], function(){

    Route::get('panel/dashboard', [DashboardController::class,'dashboard']);

    Route::get('panel/admin', [AdminController::class,'admin_list']);
    Route::get('panel/admin/create', [AdminController::class,'create_admin']);
    Route::post('panel/admin/create', [AdminController::class,'insert_admin']);
    Route::get('panel/admin/edit/{id}', [AdminController::class,'edit_admin']);
    Route::post('panel/admin/edit/{id}', [AdminController::class,'update_admin']);
    Route::get('panel/admin/delete/{id}', [AdminController::class,'delete_admin']);



    Route::get('panel/school', [SchoolController::class,'school_list']);
    Route::get('panel/school/create', [SchoolController::class,'create_school']);
    Route::post('panel/school/create', [SchoolController::class,'insert_school']);
    Route::get('panel/school/edit/{id}', [SchoolController::class,'edit_school']);
    Route::post('panel/school/edit/{id}', [SchoolController::class,'update_school']);
    Route::get('panel/school/delete/{id}', [SchoolController::class,'delete_school']);


});





