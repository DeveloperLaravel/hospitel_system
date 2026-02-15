<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radiology extends Model
{
    protected $fillable = [
        'patient_id',
        'doctor_id',
        'scan_type',
        'result',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
