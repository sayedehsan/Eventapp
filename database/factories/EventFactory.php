<?php

namespace Database\Factories;

use App\Models\EventType;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventTypeIds = EventType::pluck('id')->toArray();

        return [
            'event_type_id' => fake()->randomElement($eventTypeIds), // Assign a random existing event type ID
            'title' => fake()->sentence(),
            'description' => fake()->paragraph(3),
            'venue' => fake()->city(),
            'guest_capacity' => fake()->numberBetween(10, 500),
            'banner' => fake()->imageUrl(800, 200, 'events', true), // Generate a random image URL
            'status' => fake()->randomElement(['draft','published','cancelled']),
        ];
    }
}
