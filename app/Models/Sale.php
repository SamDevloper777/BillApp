<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'bill_no',
        'customer_id',
        'date',
        'total_amount',
        'discount',
        'tax',
        'final_amount',
        'payment_type',
    ];
}
