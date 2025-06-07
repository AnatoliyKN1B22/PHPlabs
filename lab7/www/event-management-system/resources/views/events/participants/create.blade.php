@extends('layouts.app')

@section('title', 'Додати нового учасника')

@section('content')
<div class="container">
    <h2>Додати нового учасника</h2>

    <form action="{{ route('participants.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Ім'я</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group mt-2">
            <label for="email">Електронна пошта</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Зберегти</button>
        <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">Назад</a>
    </form>
</div>
@endsection
