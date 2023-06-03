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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('department_id')->constrained('departments')->onDelete('restrict');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_no')->unique();
            $table->string('image_url');
            $table->string('Address');
            $table->foreignId('city_id')->constrained('cities')->onDelete('restrict');
            $table->foreignId('country_id')->constrained('countries')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
