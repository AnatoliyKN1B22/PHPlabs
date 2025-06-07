@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Глобальний список учасників</h1>
    <a href="{{ route('participants.create_global') }}" class="btn btn-primary mb-3">Додати нового учасника</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ім'я</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            @forelse($participants as $participant)
                <tr>
                    <td>{{ $participant->full_name }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>{{ $participant->phone ?? '—' }}</td>
                    <td>
                        <a href="{{ route('participants.edit_global', $participant->id) }}" class="btn btn-sm btn-warning">Редагувати</a>

                        <form action="{{ route('participants.destroy_global', $participant->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Ви впевнені, що хочете видалити цього учасника з глобального списку?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Учасників немає.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection