<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_type_id',
        'title',
        'description',
        'venue',
        'guest_capacity',
        'banner',
        'status',
    ];

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class);
    }
    public function invitations(): HasMany
    {
        return $this->hasMany(Invitation::class);
    }
}
