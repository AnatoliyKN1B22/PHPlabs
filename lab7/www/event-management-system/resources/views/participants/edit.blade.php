@extends('layouts.app')

@section('title', 'Редагувати учасника')

@section('content')
<div class="container">
    <h1>Редагувати учасника: {{ $participant->name }}</h1>

    <form action="{{ route('events.participants.update', [$event, $participant]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Ім’я</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $participant->name }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Електронна пошта</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $participant->email }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="{{ route('events.participants.index', $event) }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection
