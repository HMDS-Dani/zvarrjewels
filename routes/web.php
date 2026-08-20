<?php

use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StorefrontController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| CUSTOMER STOREFRONT ROUTES (Public)
|--------------------------------------------------------------------------
*/
Route::get('/', [StorefrontController::class, 'index'])->name('home');
Route::get('/shop', [StorefrontController::class, 'shop'])->name('shop.index');
Route::get('/category/{slug}', [StorefrontController::class, 'category'])->name('shop.category');
Route::get('/product/{slug}', [StorefrontController::class, 'product'])->name('shop.product');
Route::get('/about', [StorefrontController::class, 'about'])->name('about');
Route::get('/contact', [StorefrontController::class, 'contact'])->name('contact');
Route::post('/contact/inquiry', [StorefrontController::class, 'submitContactInquiry'])->name('contact.inquiry');
Route::post('/reviews', [StorefrontController::class, 'submitReview'])->name('reviews.submit');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Login, Register, Logout)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN CRM ROUTES (Protected by 'auth' & 'admin' middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Overview
    Route::get('/', [AdminProductController::class, 'dashboard'])->name('dashboard');

    // Jewellery Products Management (CRUD)
    Route::resource('products', AdminProductController::class);

    // Categories Management
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::post('categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::put('categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('categories/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Customer Inquiries & Messages
    Route::get('inquiries', [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::put('inquiries/{id}/status', [AdminInquiryController::class, 'updateStatus'])->name('inquiries.status');
    Route::delete('inquiries/{id}', [AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

    // Customer Reviews Management (CRUD)
    Route::get('reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::post('reviews', [AdminReviewController::class, 'store'])->name('reviews.store');
    Route::put('reviews/{id}', [AdminReviewController::class, 'update'])->name('reviews.update');
    Route::delete('reviews/{id}', [AdminReviewController::class, 'destroy'])->name('reviews.destroy');

    // Store Contacts & Social Links Management
    Route::get('contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::post('contacts', [AdminContactController::class, 'update'])->name('contacts.update');
});
