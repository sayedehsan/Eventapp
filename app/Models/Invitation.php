<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'user_id',
        'guest_email',
        'code',
        'qr',
        'status',
        'attendance',
        'sent_at',
        'responded_at',
    ];
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function guest(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
