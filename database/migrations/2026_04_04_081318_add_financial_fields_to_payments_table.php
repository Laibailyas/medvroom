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
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('platform_fee', 10, 2)->after('amount')->default(0);
            $table->decimal('provider_payout', 10, 2)->after('platform_fee')->default(0);
            $table->string('payout_status')->after('provider_payout')->default('pending'); // pending, completed, failed
            $table->string('payment_intent_id')->nullable()->after('transaction_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['platform_fee', 'provider_payout', 'payout_status', 'payment_intent_id']);
        });
    }
};
