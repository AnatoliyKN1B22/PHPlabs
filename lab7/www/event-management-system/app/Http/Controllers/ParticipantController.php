<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    // Методи для ресурсних маршрутів (events.participants.*)
    public function index(Event $event)
    {
        $participants = $event->participants;
        return view('participants.index', compact('event', 'participants'));
    }

    public function create(Event $event)
    {
        return view('participants.create', compact('event'));
    }

    public function store(Request $request, Event $event)
    {
        $data = $request->validate([
            'full_name' => 'required|string', // Змінено з 'name' на 'full_name'
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20', // Додано поле 'phone'
        ]);

        $event->participants()->create($data);

        return redirect()->route('events.participants.index', $event)->with('success', 'Учасника додано');
    }

    public function show(Event $event, Participant $participant)
    {
        return view('participants.show', compact('event', 'participant'));
    }

    public function edit(Event $event, Participant $participant)
    {
        return view('participants.edit', compact('event', 'participant'));
    }

    public function update(Request $request, Event $event, Participant $participant)
    {
        $data = $request->validate([
            'full_name' => 'required|string', // Змінено з 'name' на 'full_name'
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20', // Додано поле 'phone'
        ]);

        $participant->update($data);

        return redirect()->route('events.participants.index', $event)->with('success', 'Учасника оновлено');
    }

    public function destroy(Event $event, Participant $participant)
    {
        $participant->delete();

        return redirect()->route('events.participants.index', $event)->with('success', 'Учасника видалено');
    }

    // Методи для глобального управління учасниками (не прив'язані до конкретної події)
    public function listAll()
    {
        $participants = Participant::all();
        return view('participants.global_index', compact('participants')); // Припускаємо, що у вас буде окреме представлення для глобального списку
    }

    public function createGlobal()
    {
        return view('participants.global_create'); // Представлення для створення глобального учасника
    }

    public function storeGlobal(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:participants,email', // Email унікальний для всіх учасників
            'phone' => 'nullable|string|max:20',
        ]);

        Participant::create($data);

        return redirect()->route('participants.list')->with('success', 'Учасника додано до глобального списку');
    }

    public function editGlobal(Participant $participant)
    {
        return view('participants.global_edit', compact('participant')); // Представлення для редагування глобального учасника
    }

    public function updateGlobal(Request $request, Participant $participant)
    {
        $data = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:participants,email,' . $participant->id, // Унікальний email, але ігноруємо поточний
            'phone' => 'nullable|string|max:20',
        ]);

        $participant->update($data);

        return redirect()->route('participants.list')->with('success', 'Учасника оновлено у глобальному списку');
    }

    public function destroyGlobal(Participant $participant)
    {
        $participant->delete();

        return redirect()->route('participants.list')->with('success', 'Учасника видалено з глобального списку');
    }
}