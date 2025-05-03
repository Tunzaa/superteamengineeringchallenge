<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'amount',
    ];

    /**
     * The user who made the sale.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The product that was sold.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
