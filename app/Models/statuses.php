<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class statuses extends Model
{

        // // Define relationship to sales
        // public function sales()
        // {
        //     return $this->hasMany(Sale::class);
        // }
    
        // Get statuses by module (including color)
        public static function getStatusesByModule($module = null)
        {
            return $module ? self::where('module', $module)->get() : self::all();
        }
    
        // Get global statuses (including color)
        public static function getGlobalStatuses()
        {
            return self::where('is_global', true)->get();
        }
    
        // Accessor for color (if needed, to handle color formatting)
        public function getColorAttribute($value)
        {
            return $value ?? '#000000'; // Default to black if no color is set
        }
    }
    
