@extends('layouts.layout')

@section('title', 'Отзывы')
@section('content')
    <div class="container my-5">
         @auth
        <h1 class="mb-4">Отзыв</h1>

        <!-- Сообщения -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

       
        {{-- Форма для оставления отзыва (только по завершённым курсам) --}}
        @if ($completedSchedules->isNotEmpty())
            <h3>Оставить отзыв по завершённым курсам</h3>
            <form action="{{ route('reviews.send') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="schedule_id" class="form-label">Выберите курс</label>
                    <select name="schedule_id" id="schedule_id" class="form-control" required>
                        @foreach ($completedSchedules as $schedule)
                            {{-- Проверяем, чтобы пользователь не оставлял повторный отзыв --}}
                            @if (!in_array($schedule->id, $existingReviews))
                                <option value="{{ $schedule->id }}">
                                    {{ $schedule->ScheItem->name_t ?? 'Курс' }} - {{ $schedule->date ?? '' }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="rang" class="form-label">Оценка (от 1 до 5)</label>
                    <input type="number" min="1" max="5" class="form-control" name="rang" id="rang"
                        required>
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Ваш отзыв</label>
                    <textarea class="form-control" name="text" id="text" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        @else
            <p>Нет завершённых курсов для оставления отзыва.</p>
        @endif <hr>
        @endauth

        {{-- Отображение отзывов --}}
        <h2 class="mt-5">Отзывы</h2>
        @if ($reviews->count())
            <div class="row">
                @foreach ($reviews as $review)
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $review->ReviewUser->FIO }}</h5>
                                <p class="card-subtitle mb-2 text-muted">
                                    {{ $review->rang }} <span class="text-warning">&#9733;</span>
                                    @if ($review->status === 'новая')
                                        <small class="text-muted">(новая)</small>
                                    @elseif($review->status === 'принять')
                                        <small class="text-success">(принять)</small>
                                    @elseif($review->status === 'отклонен')
                                        <small class="text-danger">(отклонен)</small>
                                    @endif
                                </p>
                                <p class="card-text">{!! nl2br(e($review->text)) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Отзывов нет.</p>
        @endif
    </div>
@endsection
