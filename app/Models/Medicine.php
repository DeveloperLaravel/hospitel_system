<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'quantity',
        'price',
        'expiry_date',
    ];

    // علاقة مع الفواتير (إن وجدت)
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class, 'invoice_medicine')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
