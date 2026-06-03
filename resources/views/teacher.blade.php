
@extends('layouts.layout')

@section('content')
<div class="container py-5">
    <!-- Заголовок -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold text-dark">Наши Преподаватели</h1>
        <p class="text-muted fs-5">Профессионалы, которые помогут вам достичь новых высот</p>
        <div class="mx-auto mt-3" style="width: 50px; height: 4px; background-color: #0d6efd; border-radius: 2px;"></div>
    </div>

    <div class="row">
        @forelse($teachers as $teacher)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm teacher-card">
                    <!-- Контейнер для фото с эффектом -->
                    <div class="teacher-photo-wrapper">
                        @if($teacher->photo)
                            <img src="{{ asset('assets/img/' . $teacher->photo) }}" class="card-img-top" alt="{{ $teacher->TutorUser->FIO }}">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" class="card-img-top" alt="No photo">
                        @endif
                        <!-- Бейдж с предметом поверх фото (опционально) -->
                        <div class="photo-overlay">
                            <span class="badge bg-white text-dark shadow-sm px-3 py-2">
                                {{ $teacher->TutorItem->name_t }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <div class="text-center mb-3">
                            <h4 class="card-title fw-bold mb-1 text-dark">{{ $teacher->TutorUser->FIO }}</h4>
                            <div class="text-primary small fw-semibold">
                                <i class="bi bi-mortarboard-fill me-1"></i> Эксперт
                            </div>
                        </div>
                        
                        <hr class="my-3 opacity-25">

                        <div class="teacher-info">
                            <div class="d-flex align-items-center mb-2">
                                <div class="icon-box me-3">
                                    <i class="bi bi-book text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Предмет</small>
                                    <span class="fw-medium">{{ $teacher->TutorItem->name_t }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="icon-box me-3">
                                    <i class="bi bi-award text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Стаж</small>
                                    <span class="fw-medium">{{ $teacher->experience }} лет опыта</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                </div>
                <h3 class="text-muted">Преподаватели пока не добавлены.</h3>
                <p>Заходите позже или свяжитесь с нами.</p>
            </div>
        @endforelse
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
