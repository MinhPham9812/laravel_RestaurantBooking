<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\DishController;
use App\Http\Controllers\Admin\TableController; // Thêm dòng này
use Illuminate\Support\Facades\Route;

// Trang khách hàng
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu');

// Trang đặt bàn
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/success/{id}', [BookingController::class, 'success'])->name('booking.success');

// Profile routes từ Laravel Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin area - yêu cầu đăng nhập và phải là staff
Route::middleware(['auth', 'staff'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Quản lý khách hàng
    Route::resource('customers', CustomerController::class);
    
    // Quản lý đặt bàn - cần alias vì có 2 BookingController
    Route::resource('bookings', AdminBookingController::class);
    
    // Quản lý món ăn
    Route::resource('dishes', DishController::class);
    
    // Thêm vào đây: Quản lý bàn
    Route::resource('tables', TableController::class);
    
    // Cập nhật trạng thái bàn (khi khách dùng xong)
    Route::post('/bookings/{id}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');
});

// Authentication routes
require __DIR__.'/auth.php';
