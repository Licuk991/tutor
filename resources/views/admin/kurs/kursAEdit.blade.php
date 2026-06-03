
@extends('admin.home.admin_layout')

@section('content')

<div class="container mt-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Редактирование курса: {{ old('topic', $kurs->topic) }}</h5>
            <a href="{{ route('admin.kurs.kursA') }}" class="btn btn-sm btn-secondary">
                <i class="bi bi-arrow-left"></i> Назад
            </a>
        </div>
        <div class="card-body">

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
            
            {{-- Важно: method="POST" и @method('PUT') --}}
           
<form action="{{ route('admin.kurs.update', $kurs->id )}}" method="POST">

                @csrf
                @method('PUT')

                {{-- Выбор предмета --}}
                <div class="mb-3">
                    <label for="item_id" class="form-label">Предмет (Item)</label>
                    <select name="item_id" id="item_id" class="form-select @error('item_id') is-invalid @enderror">
                        <option value="" disabled>-- Выберите предмет --</option>
                        @foreach($items as $item)
                            
<option value="{{ $item->id }}" @selected(old('item_id', $kurs->item_id) == $item->id)>
    {{ $item->name_t }}
</option>

                        @endforeach
                    </select>
                    @error('item_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Выбор класса --}}
                <div class="mb-3">
                    <label for="classes_id" class="form-label">Класс (Class)</label>
                    <select name="classes_id" id="classes_id" class="form-select @error('classes_id') is-invalid @enderror">
                        <option value="" disabled>-- Выберите класс --</option>
                        @foreach($class as $c)
                            <option value="{{ $c->id }}" @selected(old('classes_id', $kurs->classes_id) == $c->id)>
                                {{ $c->number }}
                            </option>
                        @endforeach
                    </select>
                    @error('classes_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Тема курса --}}
                <div class="mb-3">
                    <label for="topic" class="form-label">Тема курса</label>
                              <input type="text" name="topic" id="topic" 
                           class="form-control @error('topic') is-invalid @enderror" 
                           value="{{ old('topic', $kurs->topic) }}" placeholder="Введите название темы">
                    @error('topic')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Описание --}}
                <div class="mb-4">
                    <label for="description" class="form-label">Описание</label>
                    <textarea name="description" id="description" rows="5" 
                              class="form-control @error('description') is-invalid @enderror" 
                              placeholder="Краткое описание курса">{{ old('description', $kurs->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-primary px-5">
                        <i class="bi bi-save"></i> Обновить изменения
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
