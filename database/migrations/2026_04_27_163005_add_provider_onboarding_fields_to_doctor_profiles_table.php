<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->string('provider_type')->nullable()->after('referral_source');    // MD, DO, NP, PA…
            $table->enum('entity_type', ['individual', 'organization'])->default('individual')->after('provider_type');
            $table->date('date_of_birth')->nullable()->after('entity_type');
            $table->string('npi_number')->nullable()->unique()->after('date_of_birth');
            $table->json('npi_data')->nullable()->after('npi_number');               // raw API response
            $table->json('license_states')->nullable()->after('npi_data');           // [{state,number,expiry}]
            $table->boolean('telehealth_available')->default(false)->after('license_states');
            $table->json('visit_types')->nullable()->after('telehealth_available');  // ["in-person","telehealth"]
            $table->string('document_license_path')->nullable()->after('visit_types');
            $table->string('document_id_path')->nullable()->after('document_license_path');
            $table->string('document_malpractice_path')->nullable()->after('document_id_path');
            $table->unsignedTinyInteger('onboarding_step')->default(0)->after('document_malpractice_path');
            $table->timestamp('application_submitted_at')->nullable()->after('onboarding_step');
            $table->boolean('agreed_provider_agreement')->default(false)->after('application_submitted_at');
            $table->boolean('agreed_baa')->default(false)->after('agreed_provider_agreement');
            $table->boolean('agreed_license_validity')->default(false)->after('agreed_baa');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'provider_type', 'entity_type', 'date_of_birth',
                'npi_number', 'npi_data', 'license_states',
                'telehealth_available', 'visit_types',
                'document_license_path', 'document_id_path', 'document_malpractice_path',
                'onboarding_step', 'application_submitted_at',
                'agreed_provider_agreement', 'agreed_baa', 'agreed_license_validity',
            ]);
        });
    }
};
