<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'category',
        'description',
        'price',
        'cost_price',
        'stock',
        'unit',
        'reorder_level',
    ];
}
