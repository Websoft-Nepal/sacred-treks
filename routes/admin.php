<?php

use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BlogPageController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\HomePageController;
use App\Http\Controllers\Admin\PrivacyController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\TermsConditionController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TourCostIncludeController;
use App\Http\Controllers\Admin\TourPageController;
use App\Http\Controllers\Admin\TourTransportationController;
use App\Http\Controllers\Admin\TrekkingController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TourBookingController;
use App\Http\Controllers\Admin\TourItineraryController;
use App\Http\Controllers\Admin\TrekkingBookingController;
use App\Http\Controllers\Admin\TrekkingCostIncludeController;
use App\Http\Controllers\Admin\TrekkingItineraryController;
use App\Http\Controllers\Admin\TrekkingLocationController;
use App\Http\Controllers\Admin\TrekkingPageController;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

Route::prefix('admin')->name("admin.")->middleware('auth')->group(function () {
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
        Route::get('/trash',[TrekkingController::class,'trash'])->name('trash');
        Route::get('/restore/{trekking}',[TrekkingController::class,'restore'])->name('restore');
        Route::delete('/force-delete/{trekking}',[TrekkingController::class,'forceDelete'])->name('forcedelete');

        // Itinerary
        Route::prefix('itinerary')->name('itinerary.')->group(function () {
            Route::get('/{trekking_id}', [TrekkingItineraryController::class, 'index'])->name('index');
            Route::post('store', [TrekkingItineraryController::class, 'store'])->name('store');
            Route::put('update/{id}', [TrekkingItineraryController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [TrekkingItineraryController::class, 'destroy'])->name('destroy');
        });

        // Cost details
        Route::prefix('cost')->name('cost.')->group(function () {
            Route::get('/{trekking_id}', [TrekkingCostIncludeController::class, 'index'])->name('index');
            Route::post('store', [TrekkingCostIncludeController::class, 'store'])->name('store');
            Route::put('update/{id}', [TrekkingCostIncludeController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [TrekkingCostIncludeController::class, 'destroy'])->name('destroy');
        });
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
        Route::get('/trash',[BlogController::class,'trash'])->name('trash');
        Route::get('/restore/{blog}',[BlogController::class,'restore'])->name('restore');
        Route::delete('/force-delete/{blog}',[BlogController::class,'forceDelete'])->name('forcedelete');
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
        Route::get('/trash',[TourController::class,'trash'])->name('trash');
        Route::get('/restore/{tour}',[TourController::class,'restore'])->name('restore');
        Route::delete('/force-delete/{tour}',[TourController::class,'forceDelete'])->name('forcedelete');

        // Itinerary
        Route::prefix('itinerary')->name('itinerary.')->group(function () {
            Route::get('/{tour_id}', [TourItineraryController::class, 'index'])->name('index');
            Route::post('store', [TourItineraryController::class, 'store'])->name('store');
            Route::put('update/{id}', [TourItineraryController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [TourItineraryController::class, 'destroy'])->name('destroy');
        });

        // Cost details
        Route::prefix('cost')->name('cost.')->group(function () {
            Route::get('/{tour_id}', [TourCostIncludeController::class, 'index'])->name('index');
            Route::post('store', [TourCostIncludeController::class, 'store'])->name('store');
            Route::put('update/{id}', [TourCostIncludeController::class, 'update'])->name('update');
            Route::delete('destroy/{id}', [TourCostIncludeController::class, 'destroy'])->name('destroy');
        });
    });
    // social media
    Route::prefix('social')->name('social.')->group(function () {
        Route::get('/', [SocialMediaController::class, 'index'])->name('index');
        Route::put('update/{social}', [SocialMediaController::class, 'update'])->name('update');
    });

    // privacy
    Route::prefix('privacy')->name('privacy.')->group(function () {
        Route::get('/', [PrivacyController::class, 'index'])->name('index');
        Route::put('update/{privacy}', [PrivacyController::class, 'update'])->name('update');
    });

    // terms and condition
    Route::prefix('terms')->name('terms.')->group(function () {
        Route::get('/', [TermsConditionController::class, 'index'])->name('index');
        Route::put('update{terms}', [TermsConditionController::class, 'update'])->name('update');
    });
    // contact
    Route::prefix('contact')->name('contact.')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('index');
        Route::put('update{contact}', [ContactController::class, 'update'])->name('update');
    });

    // About Us

    Route::prefix('about')->name('about.')->group(function () {
        Route::get('/', [AboutUsController::class, 'index'])->name('index');
        Route::put('update{about}', [AboutUsController::class, 'update'])->name('update');
    });

    // testimonials

    Route::prefix('testimonial')->name('testimonial.')->group(function () {
        Route::get('/', [TestimonialController::class, 'index'])->name('index');
        Route::get('create', [TestimonialController::class, 'create'])->name('create');
        Route::post('store', [TestimonialController::class, 'store'])->name('store');
        Route::get('show/{testimonial}', [TestimonialController::class, 'show'])->name('show');
        Route::get('edit/{testimonial}', [TestimonialController::class, 'edit'])->name('edit');
        Route::put('update/{testimonial}', [TestimonialController::class, 'update'])->name('update');
        Route::delete('delete/{testimonial}', [TestimonialController::class, 'destroy'])->name('destroy');
    });

    // Trekking location
    Route::prefix('Trekking-location')->name('location.')->group(function () {
        Route::get('/', [TrekkingLocationController::class, 'index'])->name('index');
        Route::post('store', [TrekkingLocationController::class, 'store'])->name('store');
        Route::put('update/{id}', [TrekkingLocationController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [TrekkingLocationController::class, 'destroy'])->name('destroy');
    });

    // Tour Transportaion
    Route::prefix('Tour-transportaion')->name('transportation.')->group(function () {
        Route::get('/', [TourTransportationController::class, 'index'])->name('index');
        Route::post('store', [TourTransportationController::class, 'store'])->name('store');
        Route::put('update/{id}', [TourTransportationController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [TourTransportationController::class, 'destroy'])->name('destroy');
    });

    // Trekking location
    Route::prefix('Trekking-location')->name('location.')->group(function () {
        Route::get('/', [TrekkingLocationController::class, 'index'])->name('index');
        Route::post('store', [TrekkingLocationController::class, 'store'])->name('store');
        Route::put('update/{id}', [TrekkingLocationController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [TrekkingLocationController::class, 'destroy'])->name('destroy');
    });

    // Tour Transportaion
    Route::prefix('Tour-transportaion')->name('transportation.')->group(function () {
        Route::get('/', [TourTransportationController::class, 'index'])->name('index');
        Route::post('store', [TourTransportationController::class, 'store'])->name('store');
        Route::put('update/{id}', [TourTransportationController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [TourTransportationController::class, 'destroy'])->name('destroy');
    });

    // Tour Booking
    Route::prefix('tour-booking')->name('tour.booking.')->group(function () {
        Route::get('/', [TourBookingController::class, 'index'])->name('index');
        Route::get('show/{id}', [TourBookingController::class, 'show'])->name('show');
        Route::put('update/{id}', [TourBookingController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [TourBookingController::class, 'destroy'])->name('destroy');
    });

    // Trekking Booking
    Route::prefix('trekking-booking')->name('trekking.booking.')->group(function () {
        Route::get('/', [TrekkingBookingController::class, 'index'])->name('index');
        Route::get('show/{id}', [TrekkingBookingController::class, 'show'])->name('show');
        Route::put('update/{id}', [TrekkingBookingController::class, 'update'])->name('update');
        Route::delete('destroy/{id}', [TrekkingBookingController::class, 'destroy'])->name('destroy');
    });

    // Pages
    Route::prefix('page')->name('page.')->group(function () {
        Route::prefix('home')->name('home.')->group(function () {
            Route::get('/', [HomePageController::class, 'index'])->name('index');
            Route::put('update/{id}', [HomePageController::class, 'update'])->name('update');
        });
        Route::prefix('tour')->name('tour.')->group(function () {
            Route::get('/', [TourPageController::class, 'index'])->name('index');
            Route::put('update/{id}', [TourPageController::class, 'update'])->name('update');
        });
        Route::prefix('trekking')->name('trekking.')->group(function () {
            Route::get('/', [TrekkingPageController::class, 'index'])->name('index');
            Route::put('update/{id}', [TrekkingPageController::class, 'update'])->name('update');
        });
        Route::prefix('blog')->name('blog.')->group(function () {
            Route::get('/', [BlogPageController::class, 'index'])->name('index');
            Route::put('update/{id}', [BlogPageController::class, 'update'])->name('update');
        });
    });

    // Gallery
    Route::prefix('gallery')->name('gallery.')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('index');
        Route::post('store', [GalleryController::class, 'store'])->name('store');
        Route::put('update/{id}', [GalleryController::class, 'update'])->name('update');
        Route::delete('delete/{id}', [GalleryController::class, 'destroy'])->name('destroy');
    });

    // Subscriber
    Route::prefix('subscriber')->name('subscriber.')->group(function () {
        Route::get('/', [SubscriberController::class, 'index'])->name('index');
        Route::delete('delete/{id}', [SubscriberController::class, 'destroy'])->name('destroy');
    });
});
