<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('legal_acceptances', function (Blueprint $table) {
            $table->id();

            // The doctor/provider who accepted, and which document + version.
            $table->foreignId('doctor_profile_id')->constrained()->cascadeOnDelete();
            $table->string('document_slug'); // e.g. provider-agreement, baa, pricing-terms
            $table->string('version');

            // Audit trail fields requested: date/time accepted, provider id,
            // ip address, and a separate immutable audit timestamp distinct
            // from accepted_at (in case a record is ever corrected/replayed).
            $table->timestamp('accepted_at');
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('audited_at')->useCurrent();

            $table->timestamps();

            $table->index(['doctor_profile_id', 'document_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('legal_acceptances');
    }
};
