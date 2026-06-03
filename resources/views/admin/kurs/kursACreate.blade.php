
@extends('admin.home.admin_layout')

@section('title', 'Создание курса')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Добавить новый курс</h4>
                </div>
                <div class="card-body">
                    
                    {{-- Вывод сообщения об успехе --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    {{-- Вывод ошибок валидации --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.kurs.store') }}" method="POST">
                        @csrf

                        {{-- Выбор предмета (Items) --}}
                        <div class="mb-3">
                            <label for="item_id" class="form-label">Предмет (Item)</label>
                            <select name="item_id" id="item_id" class="form-select @error('item_id') is-invalid @enderror">
                                <option value="" selected disabled>-- Выберите предмет --</option>
                                @foreach($items as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name_t }} {{-- Замените name на ваше поле (title/name) --}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Выбор класса (Classes) --}}
                        <div class="mb-3">
                            <label for="classes_id" class="form-label">Класс (Class)</label>
                            <select name="classes_id" id="classes_id" class="form-select @error('classes_id') is-invalid @enderror">
                                <option value="" selected disabled>-- Выберите класс --</option>
                                @foreach($class as $c)
                                    <option value="{{ $c->id }}">
                                        {{ $c->number }} {{-- Замените name на ваше поле (title/name) --}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Тема курса --}}
                        <div class="mb-3">
                            <label for="topic" class="form-label">Тема курса</label>
                            <input type="text" name="topic" id="topic" 
                                   class="form-control @error('topic') is-invalid @enderror" 
                                   value="{{ old('topic') }}" placeholder="Введите название тем">
                        </div>

                        {{-- Описание --}}
                        <div class="mb-4">
                            <label for="description" class="form-label">Описание</label>
                            <textarea name="description" id="description" rows="4" 
                                      class="form-control @error('description') is-invalid @enderror" 
                                      placeholder="Краткое описание курса">{{ old('description') }}</textarea>
                        </div>

                        {{-- Кнопки управления --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.kurs.kursA') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left"></i> Назад к списку
                            </a>
                            <button type="submit" class="btn btn-success px-5">
                                Сохранить курс
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
