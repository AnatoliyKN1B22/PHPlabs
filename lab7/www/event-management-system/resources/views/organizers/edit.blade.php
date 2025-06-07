@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Редагувати організатора</h1>

    <form action="{{ route('organizers.update', $organizer->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Ім'я</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name', $organizer->name) }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email', $organizer->email) }}">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Телефон</label>
            <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $organizer->phone) }}">
            @error('phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Оновити</button>
        <a href="{{ route('organizers.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection