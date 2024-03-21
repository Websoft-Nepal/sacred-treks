<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/table',[HomeController::class,'table'])->name('admin.table');
Route::get('/admin/profile',[HomeController::class,'profile'])->name('admin.profile');
Route::put('/admin/profile-update/{id}',[HomeController::class,'updateProfile'])->name('admin.update-profile');
Route::put('/admin/password-update/{id}',[HomeController::class,'updatePassword'])->name('admin.update-password');

// Admin routes

Auth::routes();
include __DIR__ . '/admin.php';



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
