<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultationInformation extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'chief_complaint',
        'referral_form',
    ];
}