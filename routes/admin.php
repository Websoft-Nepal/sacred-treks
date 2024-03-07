<?php

use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\TrekkingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name("admin.")->group(function () {
    Route::get('/', [HomeController::class, 'index']);

    //ContactUs Route
    Route::prefix('contactus')->name('contactus.')->group(function () {
        Route::get('/', [ContactUsController::class, 'index'])->name('index');
    });

    // trekking Route
    Route::prefix('trekking')->name('trekking.')->group(function () {
        Route::get('/', [TrekkingController::class, 'index'])->name('index');
        Route::get('create', [TrekkingController::class, 'create'])->name('create');
        Route::post('store',[TrekkingController::class,'store'])->name('store');
        Route::get('/{trekking}/edit',[TrekkingController::class,'edit'])->name('edit');
        Route::put('update/{trekking}',[TrekkingController::class,'update'])->name('update');
        Route::delete('destroy/{trekking}',[TrekkingController::class,'destroy'])->name('destroy');
    });
});
