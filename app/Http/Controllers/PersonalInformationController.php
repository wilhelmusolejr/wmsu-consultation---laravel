<?php

namespace App\Http\Controllers;

use App\Models\PersonalInformation;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
    function store($appointment_id, $data)
    {
        $personal_information = PersonalInformation::create([
            'appointment_id' => $appointment_id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'birthdate' => $data['birthdate'],
            'gender' => $data['gender']
        ]);

        return $personal_information;
    }
}
