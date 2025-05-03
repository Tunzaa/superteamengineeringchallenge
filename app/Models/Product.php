<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'price', 'stock',
    ];

    /**
     * Get all sales related to this product.
     */
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
