<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    protected $fillable = ['user_id','receipt_code', 'total_amount'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'sale_product')
        ->withPivot('quantity', 'price')
        ->withTimestamps();
    }
    public function user()
{
    return $this->belongsTo(User::class);
}

}
