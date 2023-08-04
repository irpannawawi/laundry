<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Dashboard_controller;
use App\Http\Controllers\Log_controller;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProccessController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Users_controller;
use App\Models\Cart;
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

// NO AUTH REQUIRED
Route::get('/', [PublicController::class, 'index']);


Route::middleware(['auth', 'checkRole:admin'])->group(function () {
    Route::get('/dashboard',[Dashboard_controller::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // users 
    Route::get('/users', [Users_controller::class, 'index'])->name('users');
    Route::post('/users', [Users_controller::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [Users_controller::class, 'edit'])->name('users.edit');
    Route::put('/users', [Users_controller::class, 'update'])->name('users.update');
    Route::delete('/users', [Users_controller::class, 'delete'])->name('users.delete');

    // produk 
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk');
    Route::post('/produk', [Produkcontroller::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'edit'])->name('produk.edit');
    Route::put('/produk', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProdukController::class, 'destroy'])->name('produk.delete');
    
    
    // Order
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    // Proccess
    Route::get('/proccess', [proccessController::class, 'index'])->name('proccess');


    
    
});

// PUBLIC SECTION
Route::middleware(['auth', 'checkRole:customer'])->group(function () {
    Route::get('/public', [PublicController::class, 'index'])->name('public');
    Route::get('/public/profile', [PublicController::class, 'profile'])->name('publicProfile');
    Route::put('/public/profile/update/{id}', [PublicController::class, 'update_profile'])->name('publicProfileUpdate');

    // cart
    // add to Cart
    Route::get('/addToCart/{id_product}', [CartController::class, 'addToCart'])->name('addToCart');
    Route::get('/removeFromCart/{id_product}', [CartController::class, 'removeFromCart'])->name('removeFromCart');
    Route::get('/cart', [CartController::class, 'cartView'])->name('cart');
    
    // transaction 
    Route::get('/transaction', [TransactionController::class, 'view'])->name('transaction');
    Route::post('/addTransaction', [TransactionController::class, 'add'])->name('addTransaction');
    Route::post('/addPaymentInfo', [TransactionController::class, 'addPaymentInfo'])->name('addPaymentInfo');
    Route::get('/acc_transaction', [TransactionController::class, 'acc'])->name('accTransaction');
    
});

require __DIR__.'/auth.php';
