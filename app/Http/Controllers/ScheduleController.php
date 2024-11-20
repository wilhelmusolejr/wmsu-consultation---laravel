<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use DateTime;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index($id)
    {

        // Find all schedules with the given appointment_id
        $schedules = Schedule::where('appointment_id', $id)->get();

        // Check if schedules exist
        if ($schedules->isEmpty()) {
            return response()->json(['message' => 'No schedules found for the specified appointment'], 200);
        }

        // Format the date and time for each schedule
        $formattedSchedules = $schedules->map(function ($schedule) {
            // Parse the appointment_date_completed field
            $dateTime = new DateTime($schedule->appointment_date_completed);

            // Format the date and time
            $schedule->formatted_date = $dateTime->format('Y-m-d');
            $schedule->formatted_time = $dateTime->format('h:i A');

            return $schedule;
        });

        // Return the formatted schedules
        return response()->json(['schedules' => $formattedSchedules], 200);
    }

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