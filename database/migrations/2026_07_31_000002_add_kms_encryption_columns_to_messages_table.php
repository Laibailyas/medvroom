<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // message_body will now store the CIPHERTEXT (base64), not plaintext.
            // These extra columns hold what's needed to decrypt it via KMS envelope encryption.
            $table->text('encrypted_data_key')->nullable()->after('message_body');
            $table->string('cipher_iv')->nullable()->after('encrypted_data_key');
            $table->string('cipher_tag')->nullable()->after('cipher_iv');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropColumn(['encrypted_data_key', 'cipher_iv', 'cipher_tag']);
        });
    }
};