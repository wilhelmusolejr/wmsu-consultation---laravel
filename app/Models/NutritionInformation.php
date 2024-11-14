<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutritionInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'meet_past_dietitian',
        'special_diet',
        'food_preference',
        'who_grocery',
        'who_prepare_meal',
        'skip_meals'
    ];
}