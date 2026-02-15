<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Prescription extends Model
{
     use HasFactory;

    protected $fillable = [
        'medical_record_id',
        'medicine_id',
        'dosage',
        'duration',
    ];

    // علاقة مع السجل الطبي
    public function medicalRecord()
    {
        return $this->belongsTo(MedicalRecord::class);
    }

    // علاقة مع الدواء
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }

    // علاقة عبر السجل الطبي بالمريض
    public function patient()
    {
        return $this->medicalRecord->patient();
    } //
}
