<?php

namespace App\Http\Controllers;

use App\Models\NutritionInformation;
use Illuminate\Http\Request;

class NutritionInformationController extends Controller
{
    function store($appointment_id, $data)
    {
        $personal_information = NutritionInformation::create([
            'appointment_id' => $appointment_id,
            'meet_past_dietitian' => $data['meet_past_dietitian'],
            'special_diet' => $data['special_diet'],
            'food_preference' => $data['food_preference'],
            'who_grocery' => $data['who_grocery'],
            'who_prepare_meal' => $data['who_prepare_meal'],
            'skip_meals' => $data['skip_meals'],
        ]);

        return $personal_information;
    }
}