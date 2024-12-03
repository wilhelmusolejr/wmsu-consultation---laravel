<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'home'])->name('home');

Route::get('/consultation', function () {
    return view('consultation');
})->name('navigator');

Route::get('/consultation/{id}', function ($id) {
    return view('consultation', compact('id'));
});

Route::get('/my-consultation', function() {
    return view("my-consultation");
});

// Route::get('/instructors', function() {
//     return view("instructor");
// })->name('instructors');


Route::get("/instructors", [UserController::class, 'all_diatitian'])->name('instructors');


// DIETITIAN
Route::get('/dietitian/consultation', function () {
    return view('dietitian.consultation');
});

Route::get('/dietitian/consultation/{id}', function ($id) {
    return view('dietitian.consultation', compact('id')); // Dietitian view with ID
});

Route::get('/my-pending-consultation', function() {
    return view('dietitian.my-pending-consultation');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';