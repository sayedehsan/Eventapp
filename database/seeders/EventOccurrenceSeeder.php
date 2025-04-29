<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\EventOccurrence;
use Illuminate\Database\Seeder;

class EventOccurrenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EventOccurrence::factory()->count(20)->create();
    }
}
