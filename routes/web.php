<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TripController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\BookingsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MessagesController;
use Illuminate\Support\Facades\Route;

// Public Home Page
Route::get('/', function () {
    return view('welcome-new');
})->name('welcome');

// Contact form submission - add this route
Route::post('/', [MessagesController::class, 'store'])->name('messages.store');

// Public API route for fetching trips (with limit support)
Route::get('/api/trips/public', [TripController::class, 'getPublicTrips']);

Route::get('/trips/public', [TripController::class, 'getPublicTrips']);

// Public route for all trips page
Route::get('/trips', [TripController::class, 'allTrips'])->name('trips.all');

// API route for all trips with pagination and search
Route::get('/api/trips/all', [TripController::class, 'getAllTripsData']);

// Dashboard route
Route::get('/dashboard', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return app(App\Http\Controllers\DashboardController::class)->index();
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Public trip detail page
Route::get('/trips/{trip}', [TripController::class, 'showPublic'])->name('trips.show');

// Public booking route
Route::post('/bookings', [\App\Http\Controllers\BookingsController::class, 'store'])->name('bookings.store');

// Public route for storing messages (keep this as an alternative route)
Route::post('/messages', [MessagesController::class, 'store'])->name('messages.store');

// Admin routes for Trips, Comments, and Clients
Route::middleware(['auth'])->prefix('dashboard')->name('admin.')->group(function () {
    // Trip routes
    Route::resource('trips', TripController::class);

    // Client routes
    Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');

    // Booking routes
    Route::get('/bookings', [\App\Http\Controllers\BookingsController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [\App\Http\Controllers\BookingsController::class, 'show'])->name('bookings.show');
    Route::patch('/bookings/{booking}/status', [\App\Http\Controllers\BookingsController::class, 'updateStatus'])->name('bookings.updateStatus');
    Route::delete('/bookings/{booking}', [\App\Http\Controllers\BookingsController::class, 'destroy'])->name('bookings.destroy');

    Route::get('/clients', [ClientsController::class, 'index'])->name('clients.index');
    Route::get('/clients/{client}', [ClientsController::class, 'show'])->name('clients.show');
    Route::delete('/clients/{client}', [ClientsController::class, 'destroy'])->name('clients.destroy');

    // Messages routes
    Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [MessagesController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{message}/toggle-read', [MessagesController::class, 'toggleRead'])->name('messages.toggleRead');
    Route::delete('/messages/{message}', [MessagesController::class, 'destroy'])->name('messages.destroy');
});

// Public route for storing comments (outside admin middleware)
Route::post('/comments', [CommentsController::class, 'store'])->name('comments.store');

// Admin routes for managing comments
Route::middleware(['auth'])->prefix('dashboard')->name('admin.')->group(function () {
    Route::get('/comments', [CommentsController::class, 'index'])->name('comments.index');
    Route::patch('/comments/{comment}/toggle', [CommentsController::class, 'toggleVisibility'])->name('comments.toggle');
    Route::delete('/comments/{comment}', [CommentsController::class, 'destroy'])->name('comments.destroy');
});

require __DIR__.'/auth.php';
