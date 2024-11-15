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

        // Find the appointment by its ID, including related data
        $appointment = Appointment::with(['personalInformation', 'contactInformation', 'consultationInformation', 'healthInformation', 'nutritionInformation'])->find($id);

        // Check if the appointment exists and if the patient_id matches
        if ($appointment && $appointment->patient_id == $patient_id) {
            return response()->json($appointment, 200); // Success with related data
        }

        // If not found or patient_id does not match, return an error
        return response()->json(['message' => 'Appointment not found or patient mismatch'], 404);
    }

    public function store(Request $request, PersonalInformationController $personalInfoController, HealthInformationController $healthInfoController, ContactInformationController $contactInfoController, ConsultationInformationController $consultationInfoController, NutritionInformationController $nutritionInfoController)
    {
        $appointment_info = $request->input('appointment_information');

        $appointment = Appointment::create([
            'appointment_date' => $appointment_info['appointment_date'],
            'patient_id' => $appointment_info['patient_id'],
            'dietitian_id' => 'pending',
            'status' => 'pending',
            'appointment_for' => 'myself',
            'step' => 2,
        ]);

        $personal_information = $personalInfoController->store($appointment->id, $request->personal_information);
        $health_information = $healthInfoController->store($appointment->id, $request->health_information);
        $contact_information = $contactInfoController->store($appointment->id, $request->contact_information);
        $consultation_information = $consultationInfoController->store($appointment->id, $request->consultation_information);
        $nutrition_information = $nutritionInfoController->store($appointment->id, $request->nutrition_information);

        $data = [
            'appointment_information' => $appointment,
            'personal_information' => $personal_information,
            'health_information' => $health_information,
            'contact_information' => $contact_information,
            'consultation_information' => $consultation_information,
            'nutrition_information' => $nutrition_information,
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($id);

        // Check if the appointment exists
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        // If 'appointment_date_completed' is provided in the request, update it
        if ($request->has('appointment_date_completed')) {
            // Ensure appointment_date_completed is in the correct format (optional)
            $appointment->appointment_date_completed = $request->input('appointment_date_completed');
        }

        // Update the appointment with all provided request data (except 'appointment_date_completed' handled above)
        $appointment->update($request->except('appointment_date_completed'));

        // Return a success response
        return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $appointment], 200);
    }
}