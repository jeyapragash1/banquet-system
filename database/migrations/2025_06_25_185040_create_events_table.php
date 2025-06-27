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
        Schema::create('events', function (Blueprint $table) {
            $table->id();

            // Link to the customer table
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');

            // Event Details
            $table->date('inquiry_date');
            $table->string('event_type'); // wedding, reception, etc.
            $table->date('event_date');
            $table->integer('pax'); // No. of Pax
            $table->integer('sawan')->nullable(); // Optional

            // Financial Details
            $table->decimal('agreed_amount', 10, 2)->default(0);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('advance_payment', 10, 2)->default(0);
            $table->decimal('balance_amount', 10, 2)->default(0);
            
            // Tracking & Staff
            $table->string('receipt_number')->nullable();
            $table->string('event_taken_by')->nullable();
            $table->string('event_confirmed_by')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
