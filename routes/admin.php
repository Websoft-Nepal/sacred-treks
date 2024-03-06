<?php

use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name("admin.")->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('contact',[ContactUsController::class,'index']);
});
