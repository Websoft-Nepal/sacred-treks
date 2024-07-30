<?php
use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CompanyInfoController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\PagesController;
use App\Http\Controllers\Api\PrivacyController;
use App\Http\Controllers\Api\SubscribeController;
use App\Http\Controllers\Api\TermsConditionController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\TourBookingController;
use App\Http\Controllers\Api\TourController;
use App\Http\Controllers\Api\TrekkingBookingController;
use App\Http\Controllers\Api\TrekkingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Tour
Route::get('/tour/all',[TourController::class,'index'])->name("api.tour");
Route::get('/tour/{slug}',[TourController::class,'show']);
Route::get('/tour/category/{trasnportation_id}',[TourController::class,'category']);

// Trekking
Route::get('trekking/all',[TrekkingController::class,'index'])->name("api.trekking");
Route::get('/trekking/{slug}',[TrekkingController::class,'show']);
Route::get('/trekking/category/{location_id}',[TrekkingController::class,'category']);

// Contact us
Route::post('contactus',[ContactUsController::class,'store']);

Route::get('privacy',[PrivacyController::class,'index']);
Route::get('terms-condition',[TermsConditionController::class,'index']);
Route::get('aboutus',[AboutUsController::class,'index']);

// Enquiry
Route::post('trekking/enquiry',[TrekkingController::class,'enquiry']);
Route::post('tour/enquiry',[TourController::class,'enquiry']);

// Booking
Route::post('tour-booking',[TourBookingController::class,'store']);
Route::post('trekking-booking',[TrekkingBookingController::class,'store']);

// Pages
Route::prefix('page')->middleware(['throttle:api'])->group(function(){
    Route::get('home',[PagesController::class,'home']);
    Route::get('tour',[PagesController::class,'tour']);
    Route::get('trekking',[PagesController::class,'trekking']);
    Route::get('blog',[PagesController::class,'blog']);
});

// Gallery
Route::get('gallery',[PagesController::class,'gallery']);

// Main Gallery
Route::get('main-gallery',[GalleryController::class,'index']);
Route::get('gallery/category',[GalleryController::class,'category']);
Route::get('gallery/category/{slug}',[GalleryController::class,'galleryCategory']);
Route::get('gallery/{slug}',[GalleryController::class,'show']);

// Blog
Route::get('blogs',[BlogController::class,'index']);
Route::get('blog/{slug}',[BlogController::class,'show']);

// Subscribe
Route::post('subscribe',[SubscribeController::class,'store']);

// Testimonials
Route::get('testimonial',[TestimonialController::class,'index']);

// Contact and socialmedia
Route::get('company-info',[CompanyInfoController::class,'index']);
