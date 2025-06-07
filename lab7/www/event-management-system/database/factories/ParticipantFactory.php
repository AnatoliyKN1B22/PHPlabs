<?php

namespace Database\Factories;

use App\Models\Participant;
use App\Models\Event; // Ця модель більше не потрібна тут, якщо Participant не має event_id напряму
use Illuminate\Database\Eloquent\Factories\Factory;

class ParticipantFactory extends Factory
{
    protected $model = Participant::class;

    public function definition(): array
    {
        return [
            // 'event_id' => Event::factory(), // Цей рядок більше не потрібен, якщо Participants пов'язані через many-to-many
            'full_name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->e164PhoneNumber(), // Використовуйте e164PhoneNumber для більш реалістичних номерів
        ];
    }
}