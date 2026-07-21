<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * These columns are written by ProviderOnboardingController but were
     * missing from doctor_profiles, so Eloquent's mass-assignment guard was
     * silently dropping them on every save (no error — they just never
     * persisted). Every addition is guarded with hasColumn() so this is
     * safe to run even if some already exist.
     */
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            if (! Schema::hasColumn('doctor_profiles', 'practice_city')) {
                $table->string('practice_city')->nullable()->after('clinic_address');
            }
            if (! Schema::hasColumn('doctor_profiles', 'practice_state')) {
                $table->string('practice_state', 2)->nullable()->after('practice_city');
            }
            if (! Schema::hasColumn('doctor_profiles', 'license_number')) {
                $table->string('license_number')->nullable()->after('provider_type');
            }
            if (! Schema::hasColumn('doctor_profiles', 'license_expiration_date')) {
                $table->date('license_expiration_date')->nullable()->after('license_number');
            }
            if (! Schema::hasColumn('doctor_profiles', 'dea_number')) {
                $table->string('dea_number')->nullable()->after('npi_data');
            }
            if (! Schema::hasColumn('doctor_profiles', 'virtual_only')) {
                $table->boolean('virtual_only')->default(false)->after('clinic_address');
            }
            if (! Schema::hasColumn('doctor_profiles', 'services_offered')) {
                $table->json('services_offered')->nullable()->after('visit_types');
            }
            if (! Schema::hasColumn('doctor_profiles', 'insurances_accepted')) {
                $table->json('insurances_accepted')->nullable()->after('services_offered');
            }
            if (! Schema::hasColumn('doctor_profiles', 'agreed_payment_authorization')) {
                $table->boolean('agreed_payment_authorization')->default(false)->after('agreed_license_validity');
            }
            if (! Schema::hasColumn('doctor_profiles', 'baa_accepted_at')) {
                $table->timestamp('baa_accepted_at')->nullable()->after('agreed_payment_authorization');
            }
            if (! Schema::hasColumn('doctor_profiles', 'baa_accepted_ip')) {
                $table->string('baa_accepted_ip')->nullable()->after('baa_accepted_at');
            }
            if (! Schema::hasColumn('doctor_profiles', 'price_initial')) {
                $table->decimal('price_initial', 8, 2)->nullable()->after('consultation_fee');
            }
            if (! Schema::hasColumn('doctor_profiles', 'price_followup')) {
                $table->decimal('price_followup', 8, 2)->nullable()->after('price_initial');
            }
            if (! Schema::hasColumn('doctor_profiles', 'profile_photo_path')) {
                $table->string('profile_photo_path')->nullable()->after('document_malpractice_path');
            }
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'practice_city',
                'practice_state',
                'license_number',
                'license_expiration_date',
                'dea_number',
                'virtual_only',
                'services_offered',
                'insurances_accepted',
                'agreed_payment_authorization',
                'baa_accepted_at',
                'baa_accepted_ip',
                'price_initial',
                'price_followup',
                'profile_photo_path',
            ]);
        });
    }
};
