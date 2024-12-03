<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// user authenticaiton
// check if user has the right to access the appointment

use App\Http\Middleware\CheckAppointmentOwnership;
use App\Http\Middleware\AuthenticateUser;

Route::post('/appointment', [AppointmentController::class, 'store'])->middleware('auth:sanctum');


Route::post('/appointment/{id}', [AppointmentController::class, 'show'])->middleware('auth:sanctum');
Route::patch('/appointment/{id}', [AppointmentController::class, 'update'])->middleware('auth:sanctum');

Route::post("/all-appointment", [AppointmentController::class, 'allAppointments'])->middleware('auth:sanctum');
Route::post("/all-pending-appointment", [AppointmentController::class, 'allAppointmentsDietetian'])->middleware('auth:sanctum');


Route::patch('/consultation/{id}', [AppointmentController::class, 'update']);

Route::post('/schedule', [ScheduleController::class, 'store']);
Route::post('/schedule/{id}', [ScheduleController::class, 'index'])->middleware('auth:sanctum');

Route::post('/chat', [ChatController::class, 'store'])->middleware('auth:sanctum');
Route::post('/chat/{id}', [ChatController::class, 'index']);

Route::post("/register", [UserController::class, 'register']);
Route::post("/login", [UserController::class, 'login']);

Route::middleware('auth:sanctum')->post("/userinfo", [UserController::class, 'index']);
Route::middleware('auth:sanctum')->post("/logout", [UserController::class, 'logout']);
