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
    Schema::create('stock_logs', function (Blueprint $table) {
        $table->id();
        $table->foreignId('inventory_item_id')->constrained()->onDelete('cascade');
        $table->integer('change'); // Positive for Stock In, Negative for Stock Out
        $table->string('reason')->nullable(); // e.g., 'New Purchase', 'Event ID: 5', 'Damaged'
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_logs');
    }
};
