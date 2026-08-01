<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_audit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action'); // e.g. PATIENT_SENT_MESSAGE, PROVIDER_VIEWED_MESSAGE, ADMIN_DELETED_MESSAGE
            $table->string('resource'); // e.g. "message:123", "conversation:45"
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('timestamp')->useCurrent();

            $table->index(['user_id', 'timestamp']);
            $table->index('action');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_audit');
    }
};