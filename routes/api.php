<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\ChatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/appointment', [AppointmentController::class, 'store']);
Route::post('/appointment/{id}', [AppointmentController::class, 'show']);
Route::patch('/appointment/{id}', [AppointmentController::class, 'update']);

Route::patch('/consultation/{id}', [AppointmentController::class, 'update']);


Route::post('/chat', [ChatController::class, 'store']);
Route::post('/chat/{id}', [ChatController::class, 'index']);