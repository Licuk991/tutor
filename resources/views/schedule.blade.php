
@extends('layouts.layout')

@section('title', 'Мое расписание')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">Мое расписание</h1>
        <span class="badge bg-primary rounded-pill">{{ $schedules->count() }} занятий</span>
    </div>

    <div class="row g-3">
        @forelse($schedules as $schedule)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                    <!-- Цветная полоска сверху для акцента -->
                    <div class="bg-primary" style="height: 5px;"></div>
                    
                    <div class="card-body p-4">
                        <!-- Дата и Иконка -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-light rounded-3 p-2 me-3">
                                <i class="bi bi-calendar3 text-primary fs-4"></i>
                            </div>
                            <div>
                                <div class="text-muted small text-uppercase fw-bold">Дата</div>
                                <div class="fw-bold">{{ \Carbon\Carbon::parse($schedule->date)->format('d.m.Y') }}</div>
                            </div>
                        </div>

                        <hr class="text-muted opacity-25">

                        <!-- Предмет -->
                        <div class="mb-3">
                            <div class="text-muted small text-uppercase fw-bold">Предмет</div>
                            <div class="fs-5 fw-semibold text-primary">
                                {{ $schedule->ScheItem->name_t ?? 'Не указан' }}
                            </div>
                        </div>

                        <!-- Класс -->
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="text-muted small text-uppercase fw-bold">Класс</div>
                                    <span class="badge bg-light text-dark border">
                                    <i class="bi bi-layers me-1"></i> {{ $schedule->ScheClasses->number ?? '-' }}
                                </span>
                            </div>
                            
                            <!-- Статус (если есть) -->
                            <div>
                                <span class="badge {{ $schedule->status == 'новая' ? 'bg-success-subtle text-success' : 'bg-secondary-subtle text-secondary' }} rounded-pill px-3">
                                    {{ $schedule->status ?? 'Записан' }}
                                </span>
                            </div>
                        </div>

                         {{-- @if($schedule->status === 'завершен')
                    <div class="mt-4 pt-3 border-top">
                        <a href="{{ route('review', $schedule->id) }}" class="btn btn-primary btn-sm w-100 rounded-pill">
                            <i class="bi bi-chat-left-text me-1"></i> Оставить отзыв
                        </a>
                    </div>
                @endif --}}

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5 bg-light rounded-5 shadow-sm">
                    <i class="bi bi-calendar-x text-muted" style="font-size: 4rem;"></i>
                    <h3 class="mt-3 text-muted">У вас пока нет запланированных занятий</h3>
                    <p class="text-muted">Запишитесь на курс, чтобы увидеть его здесь.</p>
                    <a href="{{ route('zapiz') }}" class="btn btn-success px-4 rounded-pill mt-2">Записаться сейчас</a>
                </div>
            </div>
        @endforelse
    </div>
</div>

<!-- Подключаем иконки, если их нет в layout -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
    .card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
    .card:hover { 
        transform: translateY(-5px); 
        box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important; 
    }
</style>
@endsection
