<?php

use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\OrderAndPaymentController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

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

// Dashboard
Route::get('/dashboard', [BookController::class, 'map'])->middleware(['auth', 'verified'])->name('dashboard');

// Search Page
Route::get('/search', [BookController::class, 'search'])->name('books.search');

// Cart
// Cart Page
Route::get('/cart', [CartController::class, 'list'])->name('cart.list');
// Add to Cart (from Books List in Dashboard)
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
// Add to Cart (from Search page)
Route::post('/cart/addSearch', [CartController::class, 'addToCartSearch'])->name('cart.addSearch');
Route::delete('/cart/{orderItem}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// Order History
Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order.history');

// Order And Payment
Route::get('/order', [OrderAndPaymentController::class, 'showOrderForm'])->name('order.form');
Route::post('/continue-to-payment', [OrderAndPaymentController::class, 'continueToPayment'])->name('continue-to-payment');
Route::get('/payment', [OrderAndPaymentController::class, 'payment'])->name('payment');
Route::post('/process-payment', [OrderAndPaymentController::class, 'processPayment'])->name('process.payment');

// Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::resource('admin', AdminController::class);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
