<?php

namespace App\Http\Controllers;

use App\Models\HealthInformation;
use Illuminate\Http\Request;

class HealthInformationController extends Controller
{
    function store($appointment_id, $data)
    {
        $new_data = HealthInformation::create([
            'appointment_id' => $appointment_id,
            'height' => $data['height'],
            'weight' => $data['weight'],
            'weight_changed_past_year' => $data['weight_changed_past_year'],
            'exercise' => $data['exercise'],
            'medical_reason_no_exercise' => $data['medical_reason'],
            'stress_level' => $data['stress_level'],
        ]);

        return $new_data;
    }
}