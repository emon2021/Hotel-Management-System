<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;


$register = false;      //  $register ==true ? show register form : don't show register form

Route::controller(HomeController::class)->group(function() use ($register){
    //______admin.registration_________
    $bool = $register;
    if($bool == true)
    {
        Route::get('/admin/register', 'register_create')->name('admin.register.create')->middleware('user_prevent');
        Route::post('/admin/register/store', 'register')->name('admin.register')->middleware('user_prevent');
    }
    //______admin.login_______
    Route::get('/admin/login/create', 'login_create')->name('admin.login.create')->middleware('user_prevent');
    Route::post('/admin/login', 'login')->name('admin.login')->middleware('user_prevent');
    //______dashboard_________
    Route::get('/admin', 'index')->name('admin.home')->middleware(['auth_user','verified']);
    //______email.verification_________
    Route::get('/email/verify', 'verify_notice')->middleware(['auth'])->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resend')->middleware(['auth', 'throttle:6,1'])->name('verification.resend');
    //________logout_______
    Route::delete('/admin/logout', 'logout')->name('admin.logout');

});


//_________Food.Category.Controller___________
Route::controller(\App\Http\Controllers\Admin\FoodCategoryController::class)->middleware(['auth'])->group(function(){
    // Route::get('/admin/food/category', 'index')->name('admin.food.category');
    Route::get('/admin/food/category/create', 'create')->name('admin.food.category.create');
    Route::post('/admin/food/category/store', 'store')->name('admin.food.category.store');
    // Route::get('/admin/food/category/edit/{id}', 'edit')->name('admin.food.category.edit');
    // Route::post('/admin/food/category/update/{id}', 'update')->name('admin.food.category.update');
    // Route::post('/admin/food/category/delete/{id}', 'destroy')->name('admin.food.category.delete');
});