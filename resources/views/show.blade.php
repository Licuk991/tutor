@extends('layouts.layout')

@section('title', 'Детали курса: ' . ($kurs->KursItem->name_t ?? 'Курс'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <!-- Кнопка назад -->
            <div class="mb-4">
                <a href="{{ url()->previous() }}" class="text-decoration-none text-muted">
                    <i class="bi bi-arrow-left"></i> ← Назад к списку
                </a>
            </div>

            <!-- Основная карточка -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0 fs-4">
                            <i class="bi bi-book me-2"></i>
                            {{ $kurs->KursItem->name_t ?? 'Предмет не указан' }}
                        </h3>
                        <span class="badge bg-light text-primary fs-6">
                            Класс: {{ $kurs->KursClasses->number ?? '—' }}
                        </span>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <!-- Описание -->
                    <div class="mb-5">
                        <h5 class="text-uppercase text-muted small fw-bold mb-3">Описание курса</h5>
                        <p class="lead text-dark" style="line-height: 1.6;">
                            {{ $kurs->description }}
                        </p>
                    </div>

                    <hr class="my-4 opacity-25">

                    <!-- Темы курса -->
                    <div>
                        <h5 class="text-uppercase text-muted small fw-bold mb-3">Программа обучения (Темы)</h5>
                        <div class="p-3 bg-light rounded-3 border-start border-primary border-4">
                            <div class="text-secondary" style="white-space: pre-line; line-height: 1.8;">
                                {!! nl2br(e($kurs->topic)) !!}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
