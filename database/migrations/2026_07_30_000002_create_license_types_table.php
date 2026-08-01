<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('license_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->foreignId('license_type_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('license_types')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropConstrainedForeignId('license_type_id');
        });

        Schema::dropIfExists('license_types');
    }
};