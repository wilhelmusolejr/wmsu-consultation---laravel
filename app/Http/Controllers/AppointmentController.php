<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function show($id)
    {

        // 1. User needs to be loggedin
        // 2. If the appointment # is valid
        // 3. If the appointment belongs to the logged user

        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Get the patient_id from the request (e.g., from logged-in user or API token)
        $patient_id = $user->id;

        // Find the appointment by its ID, including related data
        $appointment = Appointment::with(['personalInformation', 'contactInformation', 'consultationInformation', 'healthInformation', 'nutritionInformation', 'dietitianInformation'])->find($id);

        // Check if the appointment exists and if the patient_id matches
        if ($appointment) {
            return response()->json($appointment, 200); // Success with related data
        }

        // If not found or patient_id does not match, return an error
        return response()->json(['message' => 'Appointment not found or patient mismatch'], 404);
    }

    public function store(Request $request, PersonalInformationController $personalInfoController, HealthInformationController $healthInfoController, ContactInformationController $contactInfoController, ConsultationInformationController $consultationInfoController, NutritionInformationController $nutritionInfoController)
    {

        // Get the authenticated user
        $user = Auth::user();

        $appointment_info = $request->input('appointment_information');

        $appointment = Appointment::create([
            'appointment_date' => $appointment_info['appointment_date'],
            'patient_id' => $user->id,
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

        $info = [
            'appointment_information' => $appointment,
            'personal_information' => $personal_information,
            'health_information' => $health_information,
            'contact_information' => $contact_information,
            'consultation_information' => $consultation_information,
            'nutrition_information' => $nutrition_information,
        ];

        $data = [
            'success' => true,
            'message' => "Appointment created successfully.",
            'data' => $info
        ];

        return response()->json($data, 201);
    }

    public function update(Request $request, $id)
    {

        // 1. User needs to be logged in
        // 2. If appointment is valid
        // 2. If user needs to own the appointment

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

        if ($request->has('dietitian_id')) {
            // Get the authenticated user
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $appointment->dietitian_id = $user->id;
        }

        // Update the appointment with all provided request data (except 'appointment_date_completed' handled above)
        $appointment->update($request->except('appointment_date_completed'));

        // Return a success response
        return response()->json(['message' => 'Appointment updated successfully', 'appointment' => $appointment], 200);
    }

    public function allAppointments()
    {


        // 1. User needs to be loggedin
        // 2. Show only apppoinments by the logged user


        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user_id = $user->id;

        if ($user->type === 'patient') {
            $appointments = Appointment::where('patient_id', $user_id)
                ->with(['consultationInformation', 'dietitianInformation'])
                ->get();
        } else {
            $appointments = Appointment::where('dietitian_id', $user_id)
            ->where('status', 'approved') // Add this line to filter by status
            ->with(['consultationInformation', 'dietitianInformation', 'personalInformation'])
            ->get();
        }

        $data = $appointments->map(function ($appointment) {
            $consultationInfo = $appointment->consultationInformation;
            $dietitianInfo = $appointment->dietitianInformation;
            $personalInfo = $appointment->personalInformation;

            // Determine dietitian name
            $dietitian_name = "Pending";
            if ($dietitianInfo) {
                $dietitian_name = $dietitianInfo->first_name . " " . $dietitianInfo->last_name;
            }

            return [
                'appointment_id' => $appointment->id,
                'chief_complaint' => $consultationInfo->chief_complaint ?? 'N/A', // Handle missing consultation info
                'dietitian_name' => $dietitian_name,
                'personal_information' => $personalInfo,
                'appointment_date' => \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y'),
                'consultation_status' => ucfirst($appointment->status ?? 'pending'),
                'consultation_result' => $consultationInfo->consultation_result ?? 'N/A', // Handle missing consultation result
            ];
        });


        return response()->json(['appointments' => $data, 'user' => $user->type], 200);
    }

    public function allAppointmentsDietetian()
    {

        // 1. User needs to be loggedin
        // 2. Show only the appointment of the user

        $appointment = Appointment::where('status', 'pending')
            ->with(['consultationInformation', 'personalInformation'])
            ->get();

        $data = $appointment->map(function ($appointment) {
            $birthdate = $appointment->personalInformation->birthdate ?? null;
            $age = $birthdate ? (int) \Carbon\Carbon::parse($birthdate)->diffInYears(now()->startOfDay()) : 'N/A';

            return [
                'appointment_id' => $appointment['id'],
                'age' => $age, // Calculated age
                'gender' => $appointment->personalInformation->gender ?? 'N/A', // Replace with the correct column
                'chief_complaint' => $appointment->consultationInformation->chief_complaint ?? 'N/A', // Replace with the correct column
                'appointment_date' => $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') : 'N/A',
            ];
        });

        return response()->json(['appointments' => $data], 200);
    }

}
