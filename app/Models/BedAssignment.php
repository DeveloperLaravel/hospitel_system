<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BedAssignment extends Model
{
     use HasFactory;

    protected $fillable = [
        'patient_id',
        'room_id',
        'start_date',
        'end_date',
    ];

    // علاقة بالمريض
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // علاقة بالغرفة
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
