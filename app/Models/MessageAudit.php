<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MessageAudit extends Model
{
    public $timestamps = false;

    protected $table = 'message_audit';

    protected $fillable = [
        'user_id',
        'action',
        'resource',
        'ip_address',
        'timestamp',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Convenience helper to record an audit event.
     * Usage: MessageAudit::record($request->user()->id, 'PATIENT_SENT_MESSAGE', "message:{$message->id}", $request->ip());
     */
    public static function record(?int $userId, string $action, string $resource, ?string $ipAddress): self
    {
        return static::create([
            'user_id'    => $userId,
            'action'     => $action,
            'resource'   => $resource,
            'ip_address' => $ipAddress,
            'timestamp'  => now(),
        ]);
    }
}