<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    public function billing()
{
    return $this->belongsTo(sale::class);
}

}
