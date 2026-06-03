@extends('admin.home.admin_layout')

@section('content')

    <div class="container mt-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                {{-- Исправил переменную: используем $item, так как это редактирование предмета --}}
                <h5 class="mb-0">Редактирование предмета: {{ old('name_t', $item->name_t) }}</h5>
                <a href="{{ route('admin.item.itemA') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left"></i> Назад
                </a>
            </div>
            <div class="card-body">

                @if (session('success'))
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

                {{-- ВАЖНО: Добавлен enctype="multipart/form-data" --}}
                <form action="{{ route('admin.item.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Название предмета --}}
                    <div class="mb-3">
                        <label for="name_t" class="form-label">Название предмета</label>
                        <input type="text" name="name_t" id="name_t"
                            class="form-control @error('name_t') is-invalid @enderror"
                            value="{{ old('name_t', $item->name_t) }}" placeholder="Введите название предмета">
                        @error('name_t')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Картинка --}}
                    <div class="mb-4">
                        <label class="form-label d-block">Текущее фото</label>
                        <div class="mb-2">
                              @if ($item->foto && file_exists(public_path('assets/img/'.$item->foto)))
                                <img src="{{ asset('assets/img/' . $item->foto) }}" alt="Current photo" class="img-thumbnail"
                                    style="max-height: 200px;">
                            @else
                                <span class="text-muted">Фото отсутствует</span>
                            @endif

                        </div>

                        <label for="foto" class="form-label">Загрузить новое фото</label>
                        <input type="file" name="foto" id="foto"
                            class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                        <small class="text-muted">Макс. размер: 2МБ (JPEG, PNG, JPG, GIF)</small>

                        @error('foto')
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
