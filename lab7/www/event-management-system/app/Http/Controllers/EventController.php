<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Organizer;
use Illuminate\Http\Request;
use App\Models\Participant; // Додано імпорт моделі Participant
use Carbon\Carbon; // Додано імпорт Carbon для форматування дати

class EventController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        Event::create($validated);

        return redirect()->route('events.index')->with('success', 'Подію створено успішно.');
    }

    public function index()
    {
        $events = Event::with('organizer')->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $organizers = Organizer::all();
        return view('events.create', compact('organizers'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $organizers = Organizer::all();
        return view('events.edit', compact('event', 'organizers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'location' => 'required|string|max:255',
            'organizer_id' => 'required|exists:organizers,id',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());

        return redirect()->route('events.index')->with('success', 'Подію оновлено успішно.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('events.index')->with('success', 'Подію видалено успішно.');
    }

    // Методи для управління учасниками події (масове призначення/зняття)
    public function editParticipants(Event $event)
    {
        // Отримуємо всіх доступних учасників
        $allParticipants = Participant::all();
        // Отримуємо ID учасників, які вже призначені для цієї події
        $eventParticipants = $event->participants->pluck('id')->toArray();

        return view('events.participants', compact('event', 'allParticipants', 'eventParticipants'));
    }

    public function updateParticipants(Request $request, Event $event)
    {
        // Синхронізуємо учасників: ті, що були вибрані, будуть призначені; ті, що не були вибрані, будуть зняті.
        $event->participants()->sync($request->input('participants', []));

        return redirect()->route('events.index')->with('success', 'Учасники події оновлено.');
    }

    // Метод для відображення форми додавання одного учасника до події (shortcut)
    public function addParticipantForm(Event $event)
    {
        $participants = Participant::all();
        return view('events.add_participant', compact('event', 'participants'));
    }

    // Метод для додавання одного учасника до події (shortcut)
    public function addParticipant(Request $request, Event $event)
    {
        $request->validate([
            'participant_id' => 'required|exists:participants,id',
        ]);

        // Використовуємо syncWithoutDetaching, щоб додати учасника, якщо його ще немає,
        // і не видаляти інших, якщо вони вже є.
        $event->participants()->syncWithoutDetaching([$request->participant_id]);

        return redirect()->route('events.show', $event)->with('success', 'Учасника додано до події');
    }
}