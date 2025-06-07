@extends('layouts.app')

@section('title', 'Учасники події')

@section('content')
<div class="container">
    <h1>Учасники події: {{ $event->title }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('events.participants.create', $event) }}" class="btn btn-primary mb-3">Додати учасника</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ім’я</th>
                <th>Email</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($participants as $participant)
                <tr>
                    <td>{{ $participant->name }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>
                        <a href="{{ route('events.participants.edit', [$event, $participant]) }}" class="btn btn-sm btn-warning">Редагувати</a>
                        <form action="{{ route('events.participants.destroy', [$event, $participant]) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Видалити?')">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('events.show', $event) }}" class="btn btn-secondary">Назад до події</a>
</div>
@endsection
