<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
  // Store a new chat message
  public function store(Request $request)
  {
      $schedule = Schedule::create([
          'appointment_id' => $request['appointment_id'],
          'schedule_date' => $request['schedule_date'],
      ]);

      return response()->json($schedule, 201);
  }
}