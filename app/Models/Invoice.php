<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
     use HasFactory;

    protected $fillable = [
        'patient_id',
        'total',
        'status',
    ];

    // علاقة بالمريض
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // علاقة بالأدوية داخل الفاتورة (pivot table: invoice_medicine)
    public function medicines()
    {
        return $this->belongsToMany(Medicine::class, 'invoice_medicine')
                    ->withPivot('quantity','price')
                    ->withTimestamps();
    }
}
