@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Список всіх учасників</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('participants.create_global') }}" class="btn btn-primary mb-3">Додати нового учасника</a>

    <div class="card">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Повне ім'я</th>
                        <th>Email</th>
                        <th>Телефон</th>
                        <th>Дії</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($participants as $participant)
                        <tr>
                            <td>{{ $participant->id }}</td>
                            <td>{{ $participant->full_name }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>{{ $participant->phone }}</td>
                            <td>
                                <a href="{{ route('participants.edit_global', $participant->id) }}" class="btn btn-sm btn-warning">Редагувати</a>

                                <form action="{{ route('participants.destroy_global', $participant->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Ви впевнені, що хочете видалити цього учасника?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Учасники відсутні</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection