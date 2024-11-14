<?php

namespace App\Http\Controllers;

use App\Models\ContactInformation;
use Illuminate\Http\Request;

class ContactInformationController extends Controller
{
    function store($appointment_id, $data)
    {
        $new_data = ContactInformation::create([
            'appointment_id' => $appointment_id,
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
        ]);

        return $new_data;
    }
}
