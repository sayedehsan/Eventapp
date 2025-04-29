<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\EventType;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        EventType::create(['name' => 'Conference']);
        EventType::create(['name' => 'Workshop']);
        EventType::create(['name' => 'Seminar']);
        EventType::create(['name' => 'Party']);
        // Add more event types as needed
    }
}
