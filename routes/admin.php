<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;


Route::controller(HomeController::class)->group(function(){

    Route::get('/admin', 'index')->name('admin.home');
    Route::get('/admin/register', 'register_create')->name('admin.register.create');
    Route::post('/admin/register/store', 'register')->name('admin.register');
    //______email.verification_________
    

});