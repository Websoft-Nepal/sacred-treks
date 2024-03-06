<?php

use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name("admin.")->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    //ContactUs Route
    Route::prefix('contactus')->name('contactus.')->group(function (){
        Route::get('contact',[ContactUsController::class,'index'])->name('index');
    });
});
