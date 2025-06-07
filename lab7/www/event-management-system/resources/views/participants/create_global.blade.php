@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Додати нового учасника (глобально)</h2>

    <form action="{{ route('participants.store_global') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="full_name" class="form-label">Повне ім'я</label>
            <input type="text" name="full_name" id="full_name" class="form-control" value="{{ old('full_name') }}" required>
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон (необов'язково)</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Додати учасника</button>
        <a href="{{ route('participants.list') }}" class="btn btn-secondary">Скасувати</a>
    </form>
</div>
@endsection