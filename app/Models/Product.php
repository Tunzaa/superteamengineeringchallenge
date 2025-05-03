<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'stock','discounted_price',
    ];

    /**
     * Get all sales related to this product.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
