@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Редагувати учасника: {{ $participant->full_name }}</h2>

    <form action="{{ route('participants.update_global', $participant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="full_name" class="form-label">Повне ім'я</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name', $participant->full_name) }}" required>
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $participant->email) }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон (необов'язково)</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $participant->phone) }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('participants.list') }}" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
@endsection