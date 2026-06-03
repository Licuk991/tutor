@extends('admin.home.admin_layout')
@section('title', 'Отзывы пользователей')

@section('content')

<h2>Отзывы пользователей</h2>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Имя пользователя</th>
            <th>Предмет</th>
            <th>Оценка</th>
            <th>Отзыв</th>
            <th>Статус</th>
            <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reviews as $review)
        <tr>
            <td>{{ $review->ReviewUser->FIO }}</td>
            <td>{{ $review->ReviewSche->ScheItem->name_t }}</td>
            <td>{{ $review->rang }}</td>
            <td>{{ $review->text }}</td>
            <td>{{ $review->status }}</td>
            <td>
                <a href="{{ route('admin.review.reviewAStatus', $review->id) }}" class="btn btn-info btn-sm">Изменить статус</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
