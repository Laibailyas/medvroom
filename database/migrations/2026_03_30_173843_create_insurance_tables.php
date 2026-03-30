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
        Schema::create('insurance_providers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('logo')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });

        Schema::create('insurance_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('insurance_providers')->onDelete('cascade');
            $table->string('name');
            $table->enum('plan_type', ['HMO', 'PPO', 'EPO', 'POS', 'OTHER'])->default('OTHER');
            $table->timestamps();
            
            $table->index(['provider_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insurance_plans');
        Schema::dropIfExists('insurance_providers');
    }
};
