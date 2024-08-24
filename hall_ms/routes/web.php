<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserImportController;
use App\Models\Booking;
use App\Models\Resident;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [DashboardController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'verified'])->group(function (){
    Route::resource('hall', HallController::class);
    Route::resource('room', RoomController::class);
    Route::resource('registerUser', RegisteredUserController::class);
    Route::resource('booking', BookingController::class);
    Route::post('booking', [BookingController::class, 'search'])->name('booking.search');
    Route::get('/rooms/{hall}/{gender}', [RoomController::class, 'getRooms']);
    Route::get('/hall/{hall}/members', [HallController::class, 'members'])->name('hall.members');
Route::get('/admin/register', [RegisteredUserController::class, 'showRegisterForm'])->name('admin.registerUser');
Route::get('/admin/upload', [RegisteredUserController::class, 'showUploadform'])->name('admin.upload');
Route::post('/import', [UserImportController::class, 'import'])->name('users.import');
Route::get('/users/template', [UserImportController::class, 'downloadTemplate'])->name('users.template');
Route::delete('/registerUser/{id}', [RegisteredUserController::class, 'destroy'])->name('registerUser.destroy');

});
Route::middleware(['auth','verified'])->group(function(){
    Route::post('/bookings/store', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/admin/manage', [BookingController::class, 'manageBooking'])->name('booking.managebooking');
    Route::get('/admin/manage/pending', [BookingController::class, 'pendingBooking'])->name('booking.pending');
    Route::resource('payment', PaymentController::class);
    Route::post('/approve/{payment}', [BookingController::class, 'approve'])->name('approve');
    Route::get('admin/approvedBooking', [BookingController::class,'approvedBooking'])->name('booking.approved');
});

Route::middleware(['auth','verified'])->group(function (){
   Route::resource('resident',ResidentController::class);
   Route::post('resident', [ResidentController::class, 'search'])->name('resident.search');
   Route::post('resident/create', [ResidentController::class, 'store'])->name('resident.store');
   Route::delete('/residents/{resident}', [ResidentController::class, 'destroy'])->name('residents.destroy');
});

Route::middleware(['auth','verified'])->group(function(){
    Route::get('callback',[PaymentController::class,'callback'])->name('callback');
    Route::get('success',[PaymentController::class,'success'])->name('success');
    Route::get('cancel',[PaymentController::class,'cancel'])->name('cancel');
    Route::post('/save-order-and-pay', [PaymentController::class, 'initialize'])->name('payment.initialize');
});

//Route::get('/room', [RoomController::class, 'index'])->name('admin.index');
//Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
require __DIR__.'/auth.php';
