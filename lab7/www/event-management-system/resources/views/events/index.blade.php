@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Список подій</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('events.create') }}" class="btn btn-primary mb-3">Додати подію</a>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Назва</th>
                        <th>Опис</th>
                        <th>Дата</th>
                        <th>Місце</th>
                        <th>Організатор</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->title }}</td>
                            <td>{{ $event->description }}</td>
                            <td>{{ $event->date->format('d.m.Y H:i') }}</td> {{-- Форматування дати --}}
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->organizer->name ?? '—' }}</td>
                            <td>
                                <a href="{{ route('events.edit', $event->id) }}" class="btn btn-sm btn-warning">Редагувати</a>

                                <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display:inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Ви впевнені, що хочете видалити цю подію?')">Видалити</button>
                                </form>

                                {{-- Посилання на форму управління учасниками --}}
                                <a href="{{ route('events.participants.manage', $event->id) }}" class="btn btn-sm btn-info">Учасники</a>
                                {{-- Посилання на форму додавання одного учасника --}}
                                <a href="{{ route('events.participants.add.form', $event->id) }}" class="btn btn-sm btn-secondary">Додати учасника</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-3">
        {{ $events->links() }} {{-- Додано пагінацію --}}
    </div>
</div>
@endsection