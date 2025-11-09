<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AuthController;

/* Landing Route */
Route::get('/', function () {
    return view('landing');
});

/* Event Route */
Route::get('/events', [EventController::class, 'index'])->name('events');

// Show event’s ticket ordering page
Route::get('/events/{id}/tickets', [EventController::class, 'show'])->name('tickets.show');

// Users Authentication Route
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/landing', [AuthController::class, 'logout'])->name('logout');

 