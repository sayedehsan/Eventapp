<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class EventOccurrence extends Model
{
    use HasFactory;
    protected $fillable = [
        'event_id',
        'event_date',
        'start_time',
        'end_time',
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
