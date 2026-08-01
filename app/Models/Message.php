<?php

namespace App\Models;

use App\Services\KmsEncryptionService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'conversation_id',
        'sender_id',
        'message_body',
        'read_at',
        'metadata',
        'is_deleted',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'metadata' => 'array',
        'is_deleted' => 'boolean',
    ];

    /**
     * Holds the decrypted plaintext once computed for this instance,
     * so we don't hit KMS repeatedly for the same model.
     */
    protected ?string $decryptedBodyCache = null;

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    /**
     * MUTATOR: whenever message_body is SET (e.g. Message::create([...])),
     * transparently encrypt it via KMS envelope encryption before it touches
     * the database. The raw `message_body` column ends up storing ciphertext.
     */
    public function setMessageBodyAttribute(string $value): void
    {
        // "This message was deleted." placeholder does not need encryption -
        // it's not PHI, and deleteMessage() also passes this here.
        if ($value === 'This message was deleted.') {
            $this->attributes['message_body'] = $value;
            $this->attributes['encrypted_data_key'] = null;
            $this->attributes['cipher_iv'] = null;
            $this->attributes['cipher_tag'] = null;

            return;
        }

        $encrypted = app(KmsEncryptionService::class)->encrypt($value);

        $this->attributes['message_body'] = $encrypted['ciphertext'];
        $this->attributes['encrypted_data_key'] = $encrypted['encrypted_data_key'];
        $this->attributes['cipher_iv'] = $encrypted['iv'];
        $this->attributes['cipher_tag'] = $encrypted['tag'];
    }

    /**
     * ACCESSOR: whenever message_body is READ, transparently decrypt it via KMS,
     * unless it's the non-encrypted deleted-message placeholder.
     */
    public function getMessageBodyAttribute(?string $value): ?string
    {
        if ($value === null || $value === 'This message was deleted.') {
            return $value;
        }

        if ($this->decryptedBodyCache !== null) {
            return $this->decryptedBodyCache;
        }

        if (empty($this->attributes['encrypted_data_key'] ?? null)) {
            // Legacy/plaintext row from before encryption was introduced.
            return $value;
        }

        $this->decryptedBodyCache = app(KmsEncryptionService::class)->decrypt(
            $value,
            $this->attributes['encrypted_data_key'],
            $this->attributes['cipher_iv'],
            $this->attributes['cipher_tag']
        );

        return $this->decryptedBodyCache;
    }
}