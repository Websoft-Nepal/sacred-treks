<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\PrivacyController;
use App\Http\Controllers\Api\TermsConditionController;
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

Route::get('/tour',[TourController::class,'index']);
Route::get('/tour/{slug}',[TourController::class,'show']);
Route::get('/tour/category/{trasnportation_id}',[TourController::class,'category']);

Route::get('trekking',[TrekkingController::class,'index']);
Route::get('/trekking/{slug}',[TrekkingController::class,'show']);
Route::get('/trekking/category/{location_id}',[TrekkingController::class,'category']);

Route::post('contactus',[ContactUsController::class,'store']);

Route::get('privacy',[PrivacyController::class,'index']);
Route::get('terms-condition',[TermsConditionController::class,'index']);
Route::get('aboutus',[AboutUsController::class,'index']);

// Booking
Route::post('tour-booking',[TourBookingController::class,'store']);
Route::post('trekking-booking',[TrekkingBookingController::class,'store']);
