<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function(){

    Route::get('/admin', 'index')->name('admin.home')->middleware(['auth','verified']);
    Route::get('/admin/register', 'register_create')->name('admin.register.create');
    Route::post('/admin/register/store', 'register')->name('admin.register');
    Route::get('/admin/login', 'register')->name('login');
    //______email.verification_________
    Route::get('/email/verify', 'verify_notice')->middleware(['auth','verified'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth','verified', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resend')->middleware(['auth','verified', 'throttle:6,1'])->name('verification.resend');

});