<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Metal extends Model
{
    protected $fillable = ['id', 'name'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
