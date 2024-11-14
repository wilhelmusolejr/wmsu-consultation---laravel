<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['appointment_date', 'status', 'patient_id', 'dietician_id', 'step'];

    public function personalInformation()
    {
        return $this->hasOne(PersonalInformation::class, 'appointment_id');
    }

    public function contactInformation()
    {
        return $this->hasOne(ContactInformation::class, 'appointment_id');
    }

    public function consultationInformation()
    {
        return $this->hasOne(ConsultationInformation::class, 'appointment_id');
    }

    public function healthInformation()
    {
        return $this->hasOne(HealthInformation::class, 'appointment_id');
    }

    public function nutritionInformation()
    {
        return $this->hasOne(NutritionInformation::class, 'appointment_id');
    }
}