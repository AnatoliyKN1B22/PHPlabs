@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Додати нового глобального учасника</h1>

    <form action="{{ route('participants.store_global') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="full_name" class="form-label">Повне ім'я</label>
            <input type="text" name="full_name" id="full_name" class="form-control" required value="{{ old('full_name') }}">
            @error('full_name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone') }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Додати</button>
        <a href="{{ route('participants.list') }}" class="btn btn-secondary">Назад до списку</a>
    </form>
</div>
@endsection