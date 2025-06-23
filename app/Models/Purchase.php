<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
     protected $fillable = [
        'invoice_number',
        'supplier_id',
        'date',
        'total_amount',
        'payment_type',
    ];
}
