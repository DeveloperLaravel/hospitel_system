<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MedicalRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'diagnosis',
        'treatment',
        'notes',
    ];

    // علاقة بالمريض
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // علاقة بالطبيب
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
