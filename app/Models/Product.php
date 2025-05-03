<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\sales;

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
    public function sales()
{
    return $this->belongsToMany(sales::class, 'sale_product')
    ->withPivot('quantity', 'price')
    ->withTimestamps();
}

}
