<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function(){

    Route::get('/admin', 'index')->name('admin.home')->middleware(['auth_user','verified']);
    Route::get('/admin/register', 'register_create')->name('admin.register.create')->middleware('user_prevent');
    Route::post('/admin/register/store', 'register')->name('admin.register')->middleware('user_prevent');
    Route::get('/admin/login/create', 'login_create')->name('admin.login.create')->middleware('user_prevent');
    Route::post('/admin/login', 'login')->name('admin.login')->middleware('user_prevent');
    //______email.verification_________
    Route::get('/email/verify', 'verify_notice')->middleware(['auth'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resend')->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
    //________logout_______
    Route::delete('/admin/logout', 'logout')->name('admin.logout');

});