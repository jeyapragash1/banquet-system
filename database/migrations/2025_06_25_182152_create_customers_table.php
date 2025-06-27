<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
{
    Schema::create('customers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->text('address')->nullable();
        $table->string('contact_number');
        $table->string('alternate_contact')->nullable(); // nullable means it's optional
        $table->string('religion_community')->nullable();
        $table->timestamps(); // This creates 'created_at' and 'updated_at' columns
    });
}
};
