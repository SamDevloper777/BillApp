<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'sku', 'category', 'metal_type', 'purity',
        'net_weight', 'gross_weight', 'wastage_percent', 'making_charge',
        'stone_weight', 'stone_type', 'purchase_price', 'sale_price',
        'stock_qty', 'image_path'
    ];

    public function metal()
    {
        return $this->belongsTo(Metal::class, 'metal_type');
    }

    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
