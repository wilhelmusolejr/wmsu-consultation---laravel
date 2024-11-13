<?php

use App\Http\Controllers\AppointmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/appointment', [AppointmentController::class, 'store']);
Route::post('/appointment/{id}', [AppointmentController::class, 'show']);