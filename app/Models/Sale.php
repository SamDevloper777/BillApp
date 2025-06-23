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
    public function customer()
{
    return $this->belongsTo(Customer::class);
}

public function payments()
{
    return $this->hasMany(PaymentMethod::class);
}

public function items()
{
    return $this->hasMany(SaleItem::class);
}

     public static function boot()
    {
        parent::boot();

        static::creating(function ($billing) {
            $billing->bill_no = self::generateBillNo();
        });
    }

    public static function generateBillNo()
    {
        $prefix = 'BILL-';
        $number = str_pad((self::max('id') ?? 0) + 1, 6, '0', STR_PAD_LEFT);
        return $prefix . $number;
    }
}
