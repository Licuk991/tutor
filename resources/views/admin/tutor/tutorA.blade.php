@extends('admin.home.admin_layout')
@section('title', 'Заявки репетитора')

@section('content')

<h2>Заявки репетитора</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Имя</th>
            <th>Email</th>
            <th>Опыт работы</th>
            <th>Предмет</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($applications as $app)
        <tr>
            <td>{{ $app->TutorUser->FIO }}</td>
            <td>{{ $app->TutorUser->email }}</td>
            <td>{{ $app->experience }} год</td>
            <td>{{ $app->TutorItem->name_t }}</td>
            <td>{{ $app->status }}</td>
            <td>
                <a href="{{ route('admin.tutor.tutorAStatus', $app->id) }}" class="btn btn-info btn-sm">Изменить статус</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
