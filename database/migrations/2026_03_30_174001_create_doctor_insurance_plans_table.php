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
        Schema::create('doctor_insurance_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('insurance_plan_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Unique constraint to prevent duplicate mappings
            $table->unique(['doctor_profile_id', 'insurance_plan_id'], 'doc_plan_unique');

            // Index for fast search by plan
            $table->index('insurance_plan_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_insurance_plans');
    }
};
