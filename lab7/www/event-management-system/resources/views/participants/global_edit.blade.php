@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагувати глобального учасника</h1>

    <form action="{{ route('participants.update_global', $participant->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="full_name" class="form-label">Повне ім'я</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required value="{{ old('full_name', $participant->full_name) }}">
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email', $participant->email) }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $participant->phone) }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Оновити</button>
        <a href="{{ route('participants.list') }}" class="btn btn-secondary">Назад до списку</a>
    </form>
</div>
@endsection