@extends('admin.home.admin_layout')
@section('title', 'Заявки записи ученика')

@section('content')

<h2>Заявки записи ученика</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Класс</th>
            <th>Предмет</th>
            <th>Дата</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($schedules as $schedule)
        <tr>
            <td>{{ $schedule->ScheUser->FIO }}</td>
            <td>{{ $schedule->ScheClasses->number }}</td>
            <td>{{ $schedule->ScheItem->name_t }}</td>
            <td>{{ $schedule->date }}</td>
            <td>{{ $schedule->status }}</td>
            <td>
                <a href="{{ route('admin.schedule.scheduleAStatus', $schedule->id) }}" class="btn btn-info btn-sm">Изменить статус</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
