<?php

namespace App\Http\Controllers;

use App\Models\ConsultationInformation;
use Illuminate\Http\Request;

class ConsultationInformationController extends Controller
{
    function store($appointment_id, $data)
    {
        $new_data = ConsultationInformation::create([
            'appointment_id' => $appointment_id,
            'chief_complaint' => $data['chief_complaint'],
        ]);

        return $new_data;
    }
}
