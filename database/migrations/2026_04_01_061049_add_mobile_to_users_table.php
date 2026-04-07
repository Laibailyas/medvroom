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
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile')->nullable()->unique()->after('email');
            $table->timestamp('mobile_verified_at')->nullable()->after('email_verified_at');
        });

        // Sync existing doctor phone numbers to the new mobile column
        $doctors = \DB::table('doctor_profiles')->whereNotNull('phone_number')->get();
        foreach ($doctors as $doctor) {
            \DB::table('users')
                ->where('id', $doctor->user_id)
                ->update(['mobile' => $doctor->phone_number]);
        }

        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn('phone_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->string('phone_number')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['mobile', 'mobile_verified_at']);
        });
    }
};
