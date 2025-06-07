<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organizer;
use App\Models\Event;
use App\Models\Participant;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Створюємо організаторів
        Organizer::factory(5)->create();

        // Створюємо події
        $events = Event::factory(20)->create();

        // Створюємо учасників (більше не прив'язані до події напряму при створенні)
        $participants = Participant::factory(100)->create();

        // Призначаємо учасників до подій випадковим чином
        $events->each(function ($event) use ($participants) {
            // Призначити від 5 до 20 випадкових учасників кожній події
            $event->participants()->attach(
                $participants->random(rand(5, 20))->pluck('id')
            );
        });

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}