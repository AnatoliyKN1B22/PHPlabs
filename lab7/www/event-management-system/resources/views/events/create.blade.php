@extends('layouts.app')

@section('title', 'Створити подію')

@section('content')
<div class="container">
    <h1>Створити подію</h1>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Назва події</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Опис</label>
            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="date">Дата та час</label>
            <input type="datetime-local" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
        </div>

        <div class="form-group">
            <label for="location">Місце проведення</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
        </div>

        <div class="form-group">
            <label for="organizer_id">Організатор</label>
            <select class="form-control" id="organizer_id" name="organizer_id" required>
                <option value="">-- Виберіть організатора --</option>
                @foreach ($organizers as $organizer)
                    <option value="{{ $organizer->id }}" {{ old('organizer_id') == $organizer->id ? 'selected' : '' }}>
                        {{ $organizer->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Зберегти</button>
    </form>
</div>
@endsection