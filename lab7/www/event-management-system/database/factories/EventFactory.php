<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'location' => $this->faker->city,
            'organizer_id' => Organizer::factory(),
        ];
    }
}