<?php

namespace Database\Factories;

use App\Models\Organizer;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizerFactory extends Factory
{
    protected $model = Organizer::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->e164PhoneNumber(), // Додано phone
        ];
    }
}