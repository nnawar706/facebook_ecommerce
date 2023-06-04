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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('year_id')->constrained('years')->onDelete('restrict');
            $table->foreignId('month_id')->constrained('months')->onDelete('restrict');
            $table->foreignId('employee_id')->constrained('employees')->onDelete('cascade');
            $table->decimal('paid_amount');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
