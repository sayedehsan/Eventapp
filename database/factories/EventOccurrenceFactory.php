<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\EventOccurrence;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EventOccurrence>
 */
class EventOccurrenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventId = Event::inRandomOrder()->first()->id ?? null;
        $startDate = Carbon::today()->addDays(rand(1, 30));
        $startTime = Carbon::createFromTime(rand(8, 18), rand(0, 59), 0)->toTimeString();
        $endTime = Carbon::createFromTimeString($startTime)->addHours(rand(1, 4))->toTimeString();

        return [
            'event_id' => $eventId,
            'event_date' => $startDate,
            'start_time' => $startTime,
            'end_time' => $endTime,
        ];
    }
}
