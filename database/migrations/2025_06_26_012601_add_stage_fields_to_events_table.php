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
        Schema::table('events', function (Blueprint $table) {
            // Add our two new columns after the 'balance_amount' column for organization
            $table->string('stage_provider')->nullable()->after('balance_amount');
            $table->decimal('stage_amount', 10, 2)->default(0)->after('stage_provider');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // This tells Laravel how to undo the migration (by dropping the columns)
            $table->dropColumn(['stage_provider', 'stage_amount']);
        });
    }
};