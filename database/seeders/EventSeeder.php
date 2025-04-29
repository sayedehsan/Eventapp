<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\EventType;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conferenceType = EventType::where('name', 'Conference')->firstOrFail();
        $workshopType = EventType::where('name', 'Workshop')->firstOrFail();

        Event::create([
            'event_type_id' => $conferenceType->id,
            'title' => 'Tech Conference 2025',
            'description' => 'The premier tech event of the year.',
            'venue' => 'Convention Center',
            'guest_capacity' => 500,
            'banner' => 'banners/tech_conference.jpg',
        ]);

        Event::create([
            'event_type_id' => $workshopType->id,
            'title' => 'Laravel for Beginners',
            'description' => 'A hands-on workshop for learning Laravel.',
            'venue' => 'Training Room A',
            'guest_capacity' => 50,
            'banner' => 'banners/laravel_workshop.jpg',
        ]);

        Event::factory()->count(5)->create(); // Generate 5 more sample events
    }
}
