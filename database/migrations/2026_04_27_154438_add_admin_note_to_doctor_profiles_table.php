<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->text('admin_note')->nullable()->after('is_verified');
            $table->timestamp('verification_decided_at')->nullable()->after('admin_note');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn(['admin_note', 'verification_decided_at']);
        });
    }
};
