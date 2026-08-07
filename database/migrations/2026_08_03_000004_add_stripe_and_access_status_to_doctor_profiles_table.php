<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            // Stripe reference IDs (never store secrets, just IDs pointing to Stripe records)
            $table->string('stripe_customer_id')->nullable()->after('stripe_connect_id');
            $table->string('stripe_subscription_id')->nullable()->after('stripe_customer_id');
            $table->string('stripe_subscription_price_id')->nullable()->after('stripe_subscription_id');

            // Internal access-control status — this is MedVroom's own source of truth,
            // separate from whatever Stripe reports, per the client's "internal access status" doc.
            $table->string('subscription_status')->nullable()->default('trialing')->after('trial_ends_at');
            // e.g. trialing, active, past_due, grace_period, canceled
            $table->string('profile_visibility_status')->nullable()->default('visible')->after('subscription_status');
            // e.g. visible, hidden
            $table->string('booking_access_status')->nullable()->default('enabled')->after('profile_visibility_status');
            // e.g. enabled, paused

            // What the provider agreed to, and when (versioned, for compliance/audit)
            $table->string('provider_agreement_version')->nullable()->after('agreed_provider_agreement');
            $table->string('payment_terms_version')->nullable()->after('provider_agreement_version');
            $table->string('pricing_policy_version')->nullable()->after('payment_terms_version');
            $table->string('insurance_attestation_version')->nullable()->after('pricing_policy_version');
            $table->timestamp('plan_accepted_at')->nullable()->after('insurance_attestation_version');
            $table->string('plan_accepted_ip_address')->nullable()->after('plan_accepted_at');
            $table->string('plan_accepted_user_agent')->nullable()->after('plan_accepted_ip_address');

            // Snapshot of what was selected/agreed to at that moment in time —
            // deliberately separate from the live `plan_id` FK, since the client's plan
            // could change later but this historical record should not.
            $table->string('selected_plan_name')->nullable()->after('plan_accepted_user_agent');
            $table->decimal('selected_monthly_price', 10, 2)->nullable()->after('selected_plan_name');
            $table->decimal('selected_per_booking_fee', 10, 2)->nullable()->after('selected_monthly_price');
        });
    }

    public function down(): void
    {
        Schema::table('doctor_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_customer_id', 'stripe_subscription_id', 'stripe_subscription_price_id',
                'subscription_status', 'profile_visibility_status', 'booking_access_status',
                'provider_agreement_version', 'payment_terms_version', 'pricing_policy_version',
                'insurance_attestation_version', 'plan_accepted_at', 'plan_accepted_ip_address',
                'plan_accepted_user_agent', 'selected_plan_name', 'selected_monthly_price',
                'selected_per_booking_fee',
            ]);
        });
    }
};