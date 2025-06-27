<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // The room ID is nullable because not every event will have a room.
            // It can be set to null if the room is un-assigned.
            $table->foreignId('room_id')->nullable()->constrained()->onDelete('set null')->after('customer_id');
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            // Drop the foreign key constraint before dropping the column
            $table->dropForeign(['room_id']);
            $table->dropColumn('room_id');
        });
    }
};