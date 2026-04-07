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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('patient_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('insurance_plan_id')->nullable()->constrained()->onDelete('set null');
            $table->dateTime('appointment_datetime');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Critical: Prevent double-booking for the same doctor at the same time
            $table->unique(['doctor_profile_id', 'appointment_datetime'], 'doc_time_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
