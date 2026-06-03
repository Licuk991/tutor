@extends('layouts.layout')

@section('title', 'Запись на курс')

@section('content')
@if(session('success'))
<div class="alert alert-success alert-success-custom" role="alert">
    <h4>{{session('success')}}</h4>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-danger-custom" role="alert">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row justify-content-center m-5">
    <div class="col-md-6 col-lg-5">
        <div class="card border-0 shadow-lg rounded-4">
            <!-- Шапка формы -->
            <div class="card-header bg-white border-0 pt-4 pb-0 text-center">
                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                    <i class="bi bi-calendar-check fs-2"></i>
                </div>
                <h3 class="fw-bold text-light">Запись на курс</h3>
                <p class="text-muted small">Заполните данные ниже, чтобы забронировать место</p>
            </div>

            <div class="card-body p-4">
                <form action="{{ route('storeZapiz') }}" method="post">
                    @csrf

                    <!-- Пользователь (только для чтения) -->
                    <div class="mb-4">
                        <label class="form-label small fw-bold text-uppercase text-muted">Вы записываетесь как</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-person text-muted"></i>
                            </span>
                            <input type="text" value="{{ Auth::user()->name ?? Auth::user()->email }}" disabled 
                                   class="form-control bg-light border-start-0 ps-0 shadow-none">
                        </div>
                    </div>

                    <!-- Предмет -->
                    <div class="mb-3">
                        <label for="item_id" class="form-label small fw-bold text-uppercase text-muted">Предмет</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-book text-primary"></i>
                            </span>
                            <select name="item_id" id="item_id" class="form-select border-start-0 ps-0 shadow-none @error('item_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('item_id') ? '' : 'selected' }}>Выберите предмет...</option>
                                @foreach ($items as $item)
                                    <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->name_t }}
                                    </option>
                                @endforeach
                            </select>
                            @error('item_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Класс -->
                    <div class="mb-3">
                        <label for="class_id" class="form-label small fw-bold text-uppercase text-muted">Класс</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-layers text-primary"></i>
                            </span>
                            <select name="class_id" id="class_id" class="form-select border-start-0 ps-0 shadow-none @error('class_id') is-invalid @enderror" required>
                                <option value="" disabled {{ old('class_id') ? '' : 'selected' }}>Выберите класс...</option>
                                @foreach($classes as $cls)
                                    <option value="{{ $cls->id }}" {{ old('class_id') == $cls->id ? 'selected' : '' }}>
                                        {{ $cls->number }}
                                    </option>
                                @endforeach
                            </select>
                            @error('class_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <!-- Дата -->
                    <div class="mb-4">
                        <label for="date" class="form-label small fw-bold text-uppercase text-muted">Желаемая дата</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="bi bi-calendar3 text-primary"></i>
                            </span>
                            <input type="date" name="date" id="date" value="{{ old('date') }}" 
                                   class="form-control border-start-0 ps-0 shadow-none @error('date') is-invalid @enderror" 
                                   required min="<?=date('Y-m-d', strtotime('+1 days'));?>">
                        </div>
                        @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Кнопка -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-3 shadow-sm py-3 fw-bold">
                            Подтвердить запись
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Подключение иконок -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

@endsection
