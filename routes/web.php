<?php

use App\Http\Controllers\Auth\PartnerRegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\VisitorController;
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

Route::get('/', [VisitorController::class, 'welcome'])->name('welcome');
Route::get('/place/{place}', [VisitorController::class, 'placeShow']);

Auth::routes();
Route::get('/register/partner', [PartnerRegisterController::class, 'index'])->name('register.partner');
Route::post('/register/partner', [PartnerRegisterController::class, 'store'])->name('create.partner');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('dashboard')->group(function() {
  Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->middleware(['auth', 'partnerOrAdminOnly'])->name('dashboard');

  
  Route::resource('/place', App\Http\Controllers\PlaceController::class)->middleware('auth');
  Route::delete('/place/image/{imagePlace}', [App\Http\Controllers\PlaceController::class, 'deleteImage'])->name('place.image.delete');
  Route::resource('/profile', App\Http\Controllers\PartnerProfileController::class)->middleware(['auth']);

  Route::get('bookings', [BookingController::class, 'showAll'])->name('booking.showAll');
});

Route::get('api/booking/{place}', [BookingController::class, 'showBooking']);
Route::post('booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/profile/setting/{user}', [App\Http\Controllers\UserProfileController::class, 'show'])->name('userProfile.show');
Route::get('/profile/setting/{user}/edit', [App\Http\Controllers\UserProfileController::class, 'edit'])->name('userProfile.edit');
Route::put('/profile/setting/{user}', [App\Http\Controllers\UserProfileController::class, 'update'])->name('userProfile.update');