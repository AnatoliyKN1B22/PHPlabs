@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Організатори</h1>
    <a href="{{ route('organizers.create') }}" class="btn btn-primary mb-3">Додати організатора</a>

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
            @foreach($organizers as $organizer)
                <tr>
                    <td>{{ $organizer->name }}</td>
                    <td>{{ $organizer->email }}</td>
                    <td>{{ $organizer->phone }}</td>
                    <td>
                        <a href="{{ route('organizers.edit', $organizer->id) }}" class="btn btn-sm btn-warning">Редагувати</a>

                        <form action="{{ route('organizers.destroy', $organizer->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Ви впевнені, що хочете видалити цього організатора?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Видалити</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection