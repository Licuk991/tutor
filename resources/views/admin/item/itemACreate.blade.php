
@extends('admin.home.admin_layout')

@section('title', 'Создание предмет')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Добавить новый предмет</h4>
                </div>
                <div class="card-body">
                    
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- ВАЖНО: добавлен enctype="multipart/form-data" для загрузки файлов --}}
                    <form action="{{ route('admin.item.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Тема курса --}}
                        <div class="mb-3">
                            <label for="name_t" class="form-label">Тема курса</label>
                            <input type="text" name="name_t" id="name_t" 
                                   class="form-control @error('name_t') is-invalid @enderror" 
                                   value="{{ old('name_t') }}" placeholder="Введите название предмета">
                            @error('name_t')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Блок загрузки картинки --}}
                        <div class="mb-3">
                            <label for="foto" class="form-label">Изображение предмета</label>
                            <input type="file" name="foto" id="foto" 
                                   class="form-control @error('foto') is-invalid @enderror" 
                                   accept="image/*">
                            <div class="form-text">Рекомендуемый формат: JPG, PNG.</div>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                       
                        {{-- Кнопки управления --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.item.itemA') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Назад к списку
                            </a>
                            <button type="submit" class="btn btn-success px-5">
                                Сохранить предмет
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
