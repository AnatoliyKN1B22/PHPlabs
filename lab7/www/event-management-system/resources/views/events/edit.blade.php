@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагувати подію</h1>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Назва події</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Опис</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="date">Дата і час</label>
            <input type="datetime-local" name="date" class="form-control" value="{{ old('date', \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i')) }}" required>
        </div>

        <div class="form-group">
            <label for="location">Місце проведення</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}" required>
        </div>

        <div class="form-group">
            <label for="organizer_id">Організатор</label>
            <select name="organizer_id" class="form-control" required>
                @foreach($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ $organizer->id == old('organizer_id', $event->organizer_id) ? 'selected' : '' }}>
                        {{ $organizer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Оновити</button>
        <a href="{{ route('events.index') }}" class="btn btn-secondary mt-3">Відміна</a>
    </form>
</div>
@endsection