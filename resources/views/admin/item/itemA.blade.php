
@extends('admin.home.admin_layout')

@section('title', 'Предметы')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Список предметов</h2>
        <a href="{{ route('admin.item.itemACreate') }}" class="btn btn-primary">Добавить предмет</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Картинка</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td><strong>{{ $item->name_t }}</strong></td>
                            <td>
                                {{-- Проверяем наличие картинки, если нет — показываем заглушку --}}
                                @if($item->foto)
                                    <img src="{{ asset('assets/img/' . $item->foto) }}" alt="{{ $item->name_t }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 5px;">
                                @else
                                    <span class="text-muted">Нет фото</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.item.itemAEdit', $item->id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                <form action="{{ route('admin.item.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Предметов пока нет</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
