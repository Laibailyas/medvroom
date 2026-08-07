<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Basic, Premium, Promoted
            $table->decimal('monthly_fee', 10, 2);
            $table->decimal('per_booking_fee', 10, 2);
            $table->boolean('is_promoted_addon')->default(false);
            $table->string('stripe_price_id')->nullable(); // filled in during Phase 4 (Stripe Connect)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};