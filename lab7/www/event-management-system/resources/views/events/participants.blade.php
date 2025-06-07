@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Призначення учасників для події: {{ $event->title }}</h2> {{-- Використовуйте $event->title замість $event->name --}}

    <form action="{{ route('events.participants.sync', $event->id) }}" method="POST">
        @csrf
        @method('PUT') {{-- Додано для обробки PUT-запиту --}}
        <div class="form-group">
            @foreach ($allParticipants as $participant) {{-- Змініть $participants на $allParticipants --}}
                <div class="form-check">
                    <input type="checkbox" name="participants[]" value="{{ $participant->id }}"
                        class="form-check-input"
                        id="participant{{ $participant->id }}"
                        {{ in_array($participant->id, $eventParticipants) ? 'checked' : '' }}> {{-- Логіка перевірки --}}
                    <label class="form-check-label" for="participant{{ $participant->id }}">
                        {{ $participant->full_name }} ({{ $participant->email }}) {{-- Використовуйте full_name --}}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary mt-3">Зберегти</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">Назад</a>
    </form>
</div>
@endsection