@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Редагування учасників події: {{ $event->name }}</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Форма додавання учасника до події --}}
    <form action="{{ route('events.participants.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="participants">Виберіть учасників:</label>
            <select name="participants[]" id="participants" class="form-control" multiple>
                @foreach ($allParticipants as $participant)
                    <option value="{{ $participant->id }}" {{ in_array($participant->id, $event->participants->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $participant->name }}
                    </option>
                @endforeach
            </select>
            <small class="form-text text-muted">Затисніть Ctrl (або Cmd) для вибору кількох учасників.</small>
        </div>

        <button type="submit" class="btn btn-primary">Оновити учасників</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
