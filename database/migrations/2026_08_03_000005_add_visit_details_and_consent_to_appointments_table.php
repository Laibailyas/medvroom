<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('specialty_id')->nullable()->after('insurance_plan_id')->constrained('specialties')->nullOnDelete();
            $table->string('visit_type')->nullable()->after('specialty_id'); // in_person, virtual, home_visit
            $table->string('patient_type')->nullable()->after('visit_type'); // new, existing

            // Patient consent / acknowledgment tracking, captured at submission time
            $table->timestamp('patient_consent_accepted_at')->nullable()->after('notes');
            $table->string('patient_consent_ip_address')->nullable()->after('patient_consent_accepted_at');
            $table->string('patient_consent_user_agent')->nullable()->after('patient_consent_ip_address');
            $table->boolean('telehealth_consent_accepted')->default(false)->after('patient_consent_user_agent');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['specialty_id']);
            $table->dropColumn([
                'specialty_id', 'visit_type', 'patient_type',
                'patient_consent_accepted_at', 'patient_consent_ip_address',
                'patient_consent_user_agent', 'telehealth_consent_accepted',
            ]);
        });
    }
};