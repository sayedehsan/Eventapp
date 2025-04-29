<?php

namespace Database\Factories;

use App\Models\Invitation;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invitation>
 */
class InvitationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eventId = Event::inRandomOrder()->first()->id ?? null;
        $userId = User::inRandomOrder()->first()->id ?? null;
        $guestEmail = fake()->unique()->safeEmail();
        $code = Str::uuid();
        $status = fake()->randomElement(['pending', 'accepted', 'declined']);
        $attendance = fake()->boolean();
        $invitedAt = fake()->dateTimeBetween('-1 month', 'now');
        $respondedAt = $status !== 'pending' ? fake()->dateTimeBetween($invitedAt, 'now') : null;

        return [
            'event_id' => $eventId,
            'user_id' => $userId,
            'guest_email' => $guestEmail,
            'code' => $code,
            'qr' => 'qrcodes/' . str_replace('-', '', $code) . '.png', // Example QR path
            'status' => $status,
            'attendance' => $attendance,
            'sent_at' => $invitedAt,
            'responded_at' => $respondedAt,
        ];
    }
}
