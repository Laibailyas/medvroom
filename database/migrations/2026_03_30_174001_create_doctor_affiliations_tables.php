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
        // Many-to-Many Specialty
        Schema::create('doctor_specialty', function (Blueprint $table) {
            $table->foreignId('doctor_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialty_id')->constrained()->onDelete('cascade');
            $table->primary(['doctor_profile_id', 'specialty_id']);
        });

        // Languages and Pivot
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('code')->unique(); // e.g. en, es, fr
            $table->timestamps();
        });

        Schema::create('doctor_language', function (Blueprint $table) {
            $table->foreignId('doctor_profile_id')->constrained()->onDelete('cascade');
            $table->foreignId('language_id')->constrained()->onDelete('cascade');
            $table->primary(['doctor_profile_id', 'language_id']);
        });

        // Education Table
        Schema::create('doctor_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_profile_id')->constrained()->onDelete('cascade');
            $table->string('degree');
            $table->string('institution');
            $table->year('graduation_year')->nullable();
            $table->timestamps();
        });

        // Certification Table
        Schema::create('doctor_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_profile_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('issuing_organization')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_certifications');
        Schema::dropIfExists('doctor_educations');
        Schema::dropIfExists('doctor_language');
        Schema::dropIfExists('languages');
        Schema::dropIfExists('doctor_specialty');
    }
};
