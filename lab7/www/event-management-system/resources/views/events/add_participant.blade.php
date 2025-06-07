@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Додати учасника до події: {{ $event->title }}</h2>

    <form action="{{ route('events.participants.add', $event->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="participant_id">Виберіть учасника</label>
            <select name="participant_id" id="participant_id" class="form-control" required>
                <option value="">-- Виберіть учасника --</option>
                @foreach($participants as $participant)
                    <option value="{{ $participant->id }}">{{ $participant->full_name }} ({{ $participant->email }})</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Додати</button>
    </form>
</div>
@endsection