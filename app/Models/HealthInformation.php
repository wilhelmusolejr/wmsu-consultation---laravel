<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'height',
        'weight',
        'weight_changed_past_year',
        'exercise',
        'medical_reason_no_exercise',
        'stress_level'
    ];
}
