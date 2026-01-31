<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SalonController as AdminSalonController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\CoinTransactionController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\SalonController as UserSalonController;
use App\Http\Controllers\User\ServiceController as UserServiceController;
use App\Http\Controllers\User\CoinRequestController; // ← هذا هو الـ Controller الوحيد اللي نستخدمه
use App\Http\Controllers\SalonOwner\DashboardController;

// ===========================
// Public Routes (User)
// ===========================
Route::get('/', [HomeController::class, 'index'])->name('home');

// عرض تفاصيل الصالون
Route::get('/salon/{id}', [UserSalonController::class, 'show'])->name('salon.show');

// عرض تفاصيل الخدمة
Route::get('/salon/{salon}/service/{service}', [UserServiceController::class, 'show'])->name('service.show');

// ===========================
// Auth Routes
// ===========================
Route::get('/login', [\App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [\App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [\App\Http\Controllers\Auth\RegisteredUserController::class, 'store']);

// ===========================
// Coin System Routes (User) - بدون إنشاء ملفات جديدة
// ===========================
Route::middleware(['auth'])->group(function () {
    // زر "Use Coins for Discount" (خصم فوري)
    Route::post('/service/{service}/redeem-coins', [CoinRequestController::class, 'redeemCoins'])
        ->name('coin.redeem.store');

    // زر "Request Coins" (بدون خصم فوري)
    Route::post('/service/{service}/request-coins', [CoinRequestController::class, 'requestCoins'])
        ->name('coin.request.store');
});

// ===========================
// Admin Routes
// ===========================
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard'); 

    Route::resource('users', UserController::class);
    Route::resource('salons', AdminSalonController::class);
    Route::resource('services', AdminServiceController::class);
    Route::resource('coin-transactions', CoinTransactionController::class);
    Route::resource('offers', \App\Http\Controllers\Admin\OfferController::class);
    Route::resource('feedbacks', \App\Http\Controllers\Admin\FeedbackController::class);
});

// ===========================
// Salon Owner Routes
// ===========================
Route::prefix('salon-owner')->middleware(['auth','role:salon_owner'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('salon.owner.dashboard');

    // Salon Management
    Route::get('/salon/create', [\App\Http\Controllers\SalonOwner\SalonController::class, 'create'])->name('salon.owner.create');
    Route::post('/salon', [\App\Http\Controllers\SalonOwner\SalonController::class, 'store'])->name('salon.owner.store');
    Route::get('/salon/{salon}/edit', [\App\Http\Controllers\SalonOwner\SalonController::class, 'edit'])->name('salon.owner.edit');
    Route::put('/salon/{salon}', [\App\Http\Controllers\SalonOwner\SalonController::class, 'update'])->name('salon.owner.update');

    // Offers
    Route::get('/salon/{salon}/offers/create', [\App\Http\Controllers\SalonOwner\OfferController::class, 'create'])->name('salon.owner.offer.create');
    Route::post('/salon/{salon}/offers', [\App\Http\Controllers\SalonOwner\OfferController::class, 'store'])->name('salon.owner.offer.store');

    // Services
    Route::get('/salon/{salon}/services/create', [\App\Http\Controllers\SalonOwner\ServiceController::class, 'create'])->name('salon.owner.service.create');
    Route::post('/salon/{salon}/services', [\App\Http\Controllers\SalonOwner\ServiceController::class, 'store'])->name('salon.owner.service.store');
    Route::get('/salon/{salon}/services/{service}/edit', [\App\Http\Controllers\SalonOwner\ServiceController::class, 'edit'])->name('salon.owner.service.edit');
    Route::put('/salon/{salon}/services/{service}', [\App\Http\Controllers\SalonOwner\ServiceController::class, 'update'])->name('salon.owner.service.update');
    Route::delete('/salon/{salon}/services/{service}', [\App\Http\Controllers\SalonOwner\ServiceController::class, 'destroy'])->name('salon.owner.service.destroy');

    // Approve/Reject Requests
    Route::post('/coin-requests/{request}/approve', [\App\Http\Controllers\SalonOwner\CoinRequestController::class, 'approve'])->name('salon.owner.request.approve');
    Route::post('/coin-requests/{request}/reject', [\App\Http\Controllers\SalonOwner\CoinRequestController::class, 'reject'])->name('salon.owner.request.reject');
});

use App\Http\Controllers\User\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update-info', [ProfileController::class, 'updateInfo'])->name('profile.update.info');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');
});