<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;

/* Landing Route */
Route::get('/', function () {
    return view('landing');
});

/* Event Route */
Route::get('/events', [EventController::class, 'index'])->name('events');

// Show event’s ticket ordering page
Route::middleware('auth')->group(function () {
Route::get('/events/{id}/tickets', [EventController::class, 'show'])->name('tickets.show');
});

// Users Authentication Route
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/', [AuthController::class, 'logout'])->name('logout');

// Cart Controller Route
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
