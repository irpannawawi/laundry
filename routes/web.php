<?php

use App\Http\Controllers\Dashboard_controller;
use App\Http\Controllers\Log_controller;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Users_controller;
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
Route::get('/', function () {
    return view('public.index');
});

Route::get('/dashboard',[Dashboard_controller::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'checkRole:admin'])->group(function () {
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
    Route::delete('/produk', [ProdukController::class, 'delete'])->name('produk.delete');

    
    
});

// PUBLIC SECTION
Route::get('/public', [PublicController::class, 'index'])->name('public');
Route::get('/public/profile', [PublicController::class, 'index'])->name('publicProfile');

require __DIR__.'/auth.php';
