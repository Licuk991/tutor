@extends('layouts.layout')

@section('title', 'Курсы')

@section('content')
<div class="container py-5">
    <!-- Заголовок и описание -->
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold">Курсы</h1>
        <p class="text-muted fs-5">Выберите предмет и класс, чтобы найти подходящее обучение</p>
        <hr class="mx-auto" style="width: 60px; height: 3px; background-color: #0d6efd; opacity: 1;">
    </div>

    <!-- Секция фильтров -->
    <div class="card border-0 shadow-sm mb-5">
        <div class="card-body p-4">
            <form action="{{route('kurs')}}" method="get" id="filterForm" class="row g-3 align-items-end">
                
                <!-- Выбор предмета -->
                <div class="col-md-5">
                    <label for="items" class="form-label fw-semibold">Предмет</label>
                    <select name="items" id="items" class="form-select form-select-lg">
                        <option value="VSE" {{$selectedItem == 'VSE' ? 'selected' : '' }}>Все предметы</option>
                        @foreach($items as $item)
                            <option value="{{$item->id}}" {{$selectedItem == $item->id ? 'selected' : ''}}>{{$item->name_t}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Выбор класса -->
                <div class="col-md-5">
                    <label for="class" class="form-label fw-semibold">Класс</label>
                    <select name="class" id="class" class="form-select form-select-lg">
                        <option value="Vse1" {{$selectedClasses == 'Vse1' ? 'selected' : ''}}>Все классы</option>
                        @foreach($classes as $cl)
                            <option value="{{$cl->id}}" {{$selectedClasses == $cl->id ? 'selected' : ''}}>{{$cl->number}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Кнопка -->
                <div class="col-md-2">
                    <button type="submit" name="submit" class="btn btn-primary btn-lg w-100 shadow-sm">
                        <i class="bi bi-search"></i> Найти
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Результаты -->
    @isset($zag)
        <div class="d-flex align-items-center mb-4">
            <h2 class="h3 mb-0 fw-bold text-dark">{{$zag}}</h2>
            <div class="flex-grow-1 ms-3" style="height: 1px; background: #dee2e6;"></div>
        </div>
    @endisset 

    <div class="row">
        @forelse ($kursy as $kurs)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm course-card">
                    <!-- Изображение с оверлеем -->
                    <div class="position-relative overflow-hidden">
                        <img src="{{ asset('assets/img/' .$kurs->KursItem->foto) }}" 
                             class="card-img-top course-img" 
                             alt="{{ $kurs->KursItem->name_t ?? 'Course' }}">
                        <div class="position-absolute top-0 start-0 m-3">
                            <span class="badge bg-primary px-3 py-2 shadow-sm">
                                {{ $kurs->KursClasses->number ?? '—' }} класс
                            </span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <h5 class="card-title fw-bold mb-3 text-dark">
                            {{ $kurs->KursItem->name_t ?? 'Без названия' }}
                        </h5>
                        
                        <p class="text-muted small mb-4">
                            <i class="bi bi-book me-1"></i> Программа курса полностью соответствует школьной программе.
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('show', ['id' => $kurs->id]) }}" class="btn btn-outline-primary w-100 rounded-pill">
                                Узнать по подробнее
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted fs-5">По вашему запросу ничего не найдено.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
