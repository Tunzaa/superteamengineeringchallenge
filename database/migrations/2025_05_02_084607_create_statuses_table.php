<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // The name of the status (e.g., 'pending', 'completed')
            $table->string('description')->nullable(); // Optional description for the status
            $table->string('module')->nullable(); // Optional: specify which module this status belongs to, e.g., 'sales', 'inventory', 'global'
            $table->boolean('is_global')->default(true); // Flag to determine if this status is for global use
            $table->string('color')->nullable(); // Color for the status, could be a hex color code or a color name
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statuses');
    }
};
