<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessLog extends Model
{
    protected $fillable = [
        'user_id',
        'ip_address',
        'action',
    ];

    /**
     * Get the user associated with the access log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
