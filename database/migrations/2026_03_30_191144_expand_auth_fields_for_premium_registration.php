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
        // users: first_name & last_name already exist from a prior run.
        // doctor_profiles: practice fields already exist from a prior run.
        // Only patient_profiles.sex is missing.
        Schema::table('patient_profiles', function (Blueprint $table) {
            if (! Schema::hasColumn('patient_profiles', 'sex')) {
                $table->enum('sex', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('patient_profiles', 'sex')) {
                $table->dropColumn('sex');
            }
        });
    }
};
