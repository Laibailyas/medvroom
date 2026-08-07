<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->foreignId('plan_id')->nullable()->after('user_id')->constrained('plans')->nullOnDelete();
            $table->boolean('is_promoted')->default(false)->after('plan_id');
            $table->timestamp('trial_ends_at')->nullable()->after('is_promoted');
            $table->boolean('profile_visible')->default(true)->after('trial_ends_at');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropForeign(['plan_id']);
            $table->dropColumn(['plan_id', 'is_promoted', 'trial_ends_at', 'profile_visible']);
        });
    }
};