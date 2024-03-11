<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PrivacyController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\TermsConditionController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TrekkingController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name("admin.")->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');

    //ContactUs Route
    Route::prefix('contactus')->name('contactus.')->group(function () {
        Route::get('/', [ContactUsController::class, 'index'])->name('index');
    });

    // trekking Route
    Route::prefix('trekking')->name('trekking.')->group(function () {
        Route::get('/', [TrekkingController::class, 'index'])->name('index');
        Route::get('create', [TrekkingController::class, 'create'])->name('create');
        Route::post('store', [TrekkingController::class, 'store'])->name('store');
        Route::get('/{trekking}/edit', [TrekkingController::class, 'edit'])->name('edit');
        Route::get('/show/{trekking}', [TrekkingController::class, 'show'])->name('show');
        Route::put('update/{trekking}', [TrekkingController::class, 'update'])->name('update');
        Route::delete('destroy/{trekking}', [TrekkingController::class, 'destroy'])->name('destroy');
    });
    // blog Route
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('index');
        Route::post('store', [BlogController::class, 'store'])->name('store');
        Route::get('create', [BlogController::class, 'create'])->name('create');
        Route::get('/{blog}/edit', [BlogController::class, 'edit'])->name('edit');
        Route::get('/show/{blog}', [BlogController::class, 'show'])->name('show');
        Route::put('/update/{blog}', [BlogController::class, 'update'])->name('update');
        Route::delete('/destroy/{blog}', [BlogController::class, 'destroy'])->name('destroy');
    });
    // Tour Route
    Route::prefix('tour')->name('tour.')->group(function () {
        Route::get('/', [TourController::class, 'index'])->name('index');
        Route::post('store', [TourController::class, 'store'])->name('store');
        Route::get('create', [TourController::class, 'create'])->name('create');
        Route::post('store', [TourController::class, 'store'])->name('store');
        Route::get('/show/{tour}', [TourController::class, 'show'])->name('show');
        Route::get('/{tour}/edit', [TourController::class, 'edit'])->name('edit');
        Route::put('/update/{tour}', [TourController::class, 'update'])->name('update');
        Route::delete('/destroy/{tour}', [TourController::class, 'destroy'])->name('destroy');
    });
    // social media
    Route::prefix('social')->name('social.')->group(function () {
        Route::get('/', [SocialMediaController::class, 'index'])->name('index');
        Route::put('update/{social}',[SocialMediaController::class,'update'])->name('update');
    });

    // privacy 
    Route::prefix('privacy')->name('privacy.')->group(function(){
        Route::get('/',[PrivacyController::class,'index'])->name('index');
        Route::put('update/{privacy}',[PrivacyController::class,'update'])->name('update');
    });

    // terms and condition 
    Route::prefix('terms')->name('terms.')->group(function(){
        Route::get('/',[TermsConditionController::class,'index'])->name('index');
        Route::put('update{terms}',[TermsConditionController::class,'update'])->name('update');
    });
    // contact
    Route::prefix('contact')->name('contact.')->group(function(){
        Route::get('/',[ContactController::class,'index'])->name('index');
        Route::put('update{contact}',[ContactController::class,'update'])->name('update');
    });
});
