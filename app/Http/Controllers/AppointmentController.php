<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function show($id, Request $request)
    {
        // Get the patient_id from the request (e.g., from logged-in user or API token)
        $patient_id = $request->input('patient_id');

        // Find the appointment by its ID
        $appointment = Appointment::find($id);

        // Check if the appointment exists and if the patient_id matches
        if ($appointment && $appointment->patient_id == $patient_id) {
            return response()->json($appointment, 200); // Success
        }

        // If not found or patient_id does not match, return an error
        return response()->json(['message' => 'Appointment not found or patient mismatch'], 404);
    }

    public function store(Request $request)
    {
        $appointment_info = $request->input('appointment_information');

        $appointment = Appointment::create([
            'appointment_date' => $appointment_info['appointment_date'],
            'patient_id' => $appointment_info['patient_id'],
            'step' => 2,
        ]);

        return response()->json($appointment, 201);
    }
}