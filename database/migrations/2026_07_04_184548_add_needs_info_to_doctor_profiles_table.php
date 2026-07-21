<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            // True while the admin has asked the provider for more info and
            // is waiting on a resubmission. Cleared automatically once the
            // admin approves or rejects the application again.
            $table->boolean('needs_info')->default(false)->after('admin_note');
            $table->timestamp('info_requested_at')->nullable()->after('needs_info');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn(['needs_info', 'info_requested_at']);
        });
    }
};
