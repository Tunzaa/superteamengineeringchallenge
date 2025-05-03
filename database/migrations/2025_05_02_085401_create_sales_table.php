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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('receipt_code')->unique(); // Unique receipt code for each sale
            $table->decimal('total_amount', 10, 2);
            
            $table->foreignId('sales_status')->nullable()->constrained('statuses')->onDelete('set null');
            $table->foreignId('payment_method')->nullable()->constrained('payment_methods')->onDelete('set null');
            $table->foreignId('payment_status')->nullable()->constrained('statuses')->onDelete('set null');
            $table->text('notes')->nullable(); // Optional notes for the sale
            $table->timestamp('sale_date')->useCurrent();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
