<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FaqController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\NotificationController;

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

// Login
Route::get('/login', [UserController::class, 'login'])->middleware('guest');
Route::post('/users/authenticate', [UserController::class, 'authenticate'])->middleware('guest');
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Register
Route::get('/register', [UserController::class, 'create'])->middleware('guest');
Route::post('/users', [UserController::class, 'store'])->middleware('guest');

// Reset Password
Route::get('/forgot-password', [UserController::class, 'forgot_password'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [UserController::class, 'send_recovery_email'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [UserController::class, 'reset_password'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [UserController::class, 'change_password'])->middleware('guest');

// Products
Route::get('/', [ProductController::class, 'index']);
Route::get('/products/new', [ProductController::class, 'create'])->middleware('admin');
Route::get('/products/{product}', [ProductController::class, 'show'])->where('product', '[0-9]+');
Route::get('/admin/products', [ProductController::class, 'manage'])->middleware('admin');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('admin')->where('product', '[0-9]+');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('admin')->where('product', '[0-9]+');
Route::put('products/{product}', [ProductController::class, 'update'])->middleware('admin')->where('product', '[0-9]+');
Route::post('/products', [ProductController::class, 'store'])->middleware('admin');
Route::patch('/admin/products/{product}', [ProductController::class, 'updateStock'])->middleware('admin')->where('product', '[0-9]+');

// Cart
Route::get('/cart', [CartController::class, 'index'])->middleware('auth', 'admin.forbidden');
Route::post('/cart/{product}', [CartController::class, 'store'])->middleware('auth', 'admin.forbidden')->where('product', '[0-9]+');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->middleware('auth', 'admin.forbidden')->where('product', '[0-9]+');
Route::delete('/cart', [CartController::class, 'clear'])->middleware('auth', 'admin.forbidden');
Route::patch('/cart/{product}', [CartController::class, 'update'])->middleware('auth', 'admin.forbidden')->where('product', '[0-9]+');

// Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->middleware('auth', 'admin.forbidden');
Route::post('/wishlist/{product}', [WishlistController::class, 'store'])->middleware('auth', 'admin.forbidden')->where('product', '[0-9]+');
Route::delete('/wishlist/{product}', [WishlistController::class, 'destroy'])->middleware('auth', 'admin.forbidden')->where('product', '[0-9]+');

// Purchase
Route::post('/checkout', [PurchaseController::class, 'store'])->middleware('auth');
Route::get('/admin/orders', [PurchaseController::class, 'index'])->middleware('admin');
Route::patch('/admin/orders/{purchase}', [PurchaseController::class, 'update'])->middleware('admin')->where('purchase', '[0-9]+');

// User
Route::get('/users/edit', [UserController::class, 'edit'])->middleware('auth');
Route::put('/users/edit', [UserController::class, 'update'])->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show'])->middleware('admin.profile')->where('user', '[0-9]+');
Route::delete('/users', [UserController::class, 'destroy'])->middleware('auth');
Route::get('/admin/users', [UserController::class, 'index'])->middleware('admin');
Route::patch('/users/{user}', [UserController::class, 'toggle_ban'])->middleware('admin')->where('user', '[0-9]+');
Route::get('/credits', [UserController::class, 'credit_options'])->middleware('auth', 'admin.forbidden');

// Paypal
Route::post('/payment', [PayPalController::class, 'payment'])->middleware('auth', 'admin.forbidden');
Route::get('/payment/success', [PayPalController::class, 'success'])->middleware('auth', 'admin.forbidden');
Route::get('/payment/cancel', [PayPalController::class, 'cancel'])->middleware('auth', 'admin.forbidden');

// Address
Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->middleware('auth')->where('address', '[0-9]+');
Route::put('/addresses/{address}', [AddressController::class, 'update'])->middleware('auth')->where('address', '[0-9]+');
Route::post('/addresses', [AddressController::class, 'store'])->middleware('auth');

// Reviews
Route::post('/reviews', [ReviewController::class, 'store']);
Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->middleware('auth')->where('review', '[0-9]+');
Route::post('/reviews/{review}/up', [ReviewController::class, 'vote_up'])->middleware('auth')->where('review', '[0-9]+');
Route::post('/reviews/{review}/down', [ReviewController::class, 'vote_down'])->middleware('auth')->where('review', '[0-9]+');

// Admin
Route::get('/admin', [AdminController::class, 'show'])->middleware('admin');

// Faq & About
Route::get('/faqs', [FaqController::class, 'index']);
Route::get('/about', function () { return view('static.about'); });

// Notifications
Route::post('/notifications/{notification}', [NotificationController::class, 'markAsRead'])->middleware('auth', 'admin.forbidden');
