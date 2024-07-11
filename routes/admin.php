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
Route::controller(\App\Http\Controllers\Admin\FoodCategoryController::class)->middleware(['auth','is_admin'])->group(function(){
    // Route::get('/admin/food/category', 'index')->name('admin.food.category');
    Route::get('/admin/food/category/create', 'create')->name('admin.food.category.create');
    Route::post('/admin/food/category/store', 'store')->name('admin.food.category.store');
    // Route::get('/admin/food/category/edit/{id}', 'edit')->name('admin.food.category.edit');
    // Route::post('/admin/food/category/update/{id}', 'update')->name('admin.food.category.update');
    // Route::post('/admin/food/category/delete/{id}', 'destroy')->name('admin.food.category.delete');
});

//_________Room.Category.Controller___________
Route::controller(\App\Http\Controllers\Admin\RoomCategoryController::class)->middleware(['auth','is_admin'])->group(function(){
    Route::get('/admin/rooms/category', 'index')->name('admin.rooms.category.index');
    Route::get('/admin/rooms/category/create', 'create')->name('admin.rooms.category.create');
    Route::post('/admin/rooms/category/store', 'store')->name('admin.rooms.category.store');
    Route::get('/admin/rooms/category/edit', 'edit')->name('admin.rooms.category.edit');
    Route::post('/admin/rooms/category/update', 'update')->name('admin.rooms.category.update');
    Route::delete('/admin/rooms/category/destroy/{id}', 'destroy')->name('admin.rooms.category.destroy');
    Route::get('/admin/rooms/category/status/{id}', 'statusUpdate')->name('admin.rooms.category.status');
});
//_________Amenity.Controller___________
Route::controller(\App\Http\Controllers\Admin\AmenityController::class)->middleware(['auth','is_admin'])->group(function(){
    Route::get('rooms/amenities/index', 'index')->name('amenity.index');
    Route::post('rooms/amenities/store', 'store')->name('amenity.store');
    Route::get('rooms/amenities/edit', 'edit')->name('amenity.edit');
    Route::post('/rooms/amenities/update', 'update')->name('amenity.update');
    Route::delete('/rooms/amenities/destroy/{id}', 'destroy')->name('amenity.destroy');
    Route::get('rooms/amenities/status', 'statusUpdate')->name('amenity.status');
});
//_________Room.Controller___________
Route::controller(\App\Http\Controllers\Admin\RoomController::class)->middleware(['auth','is_admin'])->group(function(){
    Route::get('rooms/index', 'index')->name('room.index');
    Route::post('rooms/store', 'store')->name('room.store');
    Route::get('rooms/edit', 'edit')->name('room.edit');
    Route::post('/rooms/update', 'update')->name('room.update');
    Route::delete('/rooms/destroy/{id}', 'destroy')->name('room.destroy');
    Route::get('rooms/status', 'statusUpdate')->name('room.status');
});