@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Додати нового організатора</h1>

    <form action="{{ route('organizers.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Ім'я</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
            @error('name')
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
        <a href="{{ route('organizers.index') }}" class="btn btn-secondary">Назад</a>
    </form>
</div>
@endsection