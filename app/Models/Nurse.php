<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'department_id',
    ];

    // علاقة بالقسم
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
