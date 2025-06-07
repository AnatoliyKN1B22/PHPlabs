@extends('layouts.app')

@section('title', 'Деталі події')

@section('content')
    <div class="container">
        <h1>{{ $event->title }}</h1>
        <p><strong>Опис:</strong> {{ $event->description }}</p>
        <p><strong>Дата:</strong> {{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i') }}</p>
        <p><strong>Локація:</strong> {{ $event->location }}</p>
        <p><strong>Організатор:</strong> {{ $event->organizer->name }} ({{ $event->organizer->email }})</p>

    {{-- Список учасників події --}}
    <h3>Учасники події:</h3>
    @if($event->participants->isEmpty())
        <p>Наразі учасників немає.</p>
    @else
        <ul>
            @foreach($event->participants as $participant)
                <li>{{ $participant->full_name }} ({{ $participant->email }})</li>
            @endforeach
        </ul>
    @endif

	<a href="{{ route('events.participants.add.form', ['event' => $event->id]) }}" class="btn btn-primary mb-3">Додати учасника</a>
    <a href="{{ route('events.participants.manage', $event->id) }}" class="btn btn-info mb-3">Редагувати учасників (масово)</a>


        <a href="{{ route('events.index') }}" class="btn btn-secondary">Назад до подій</a>
    </div>
@endsection