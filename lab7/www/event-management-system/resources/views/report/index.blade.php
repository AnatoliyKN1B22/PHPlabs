@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Звіт по подіях</h1>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Список подій з кількістю учасників</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Назва події</th>
                        <th>Дата</th>
                        <th>Місце проведення</th>
                        <th>Кількість учасників</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($events as $event)
                        <tr>
                            <td>{{ $event->id }}</td>
                            <td>{{ $event->title }}</td>
                            <td>{{ \Carbon\Carbon::parse($event->date)->format('d.m.Y H:i') }}</td>
                            <td>{{ $event->location }}</td>
                            <td>{{ $event->participants_count }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Події відсутні</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection