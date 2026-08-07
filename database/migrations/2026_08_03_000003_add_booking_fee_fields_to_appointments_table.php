<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('applicable_plan_at_acceptance')->nullable()->constrained('plans')->nullOnDelete();
            $table->string('fee_type')->nullable(); // e.g. 'per_booking_fee'
            $table->decimal('fee_amount', 10, 2)->nullable();
            $table->string('currency', 3)->default('USD');
            $table->timestamp('fee_displayed_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->string('stripe_payment_intent_id')->nullable();
            $table->string('stripe_charge_id')->nullable();
            $table->string('payment_status')->nullable(); // pending, succeeded, failed
            $table->timestamp('charged_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['applicable_plan_at_acceptance']);
            $table->dropColumn([
                'applicable_plan_at_acceptance', 'fee_type', 'fee_amount', 'currency',
                'fee_displayed_at', 'accepted_at', 'stripe_payment_intent_id',
                'stripe_charge_id', 'payment_status', 'charged_at', 'confirmed_at',
            ]);
        });
    }
};