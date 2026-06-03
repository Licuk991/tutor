
@extends('admin.home.admin_layout')

@section('title', 'Курсы')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Список курсов</h2>
        <a href="{{ route('admin.kurs.kursACreate') }}" class="btn btn-primary">Добавить курс</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Предмет</th>
                        <th>Класс</th>
                        <th>Темы</th>
                        <th>Описание</th>
                        <th class="text-end">Действия</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kurs as $item)
                        <tr>
                            <td>{{ $item->id }}</td> {{-- Или $item->id --}}
                            <td><strong>{{ $item->KursItem->name_t }}</strong></td> {{-- Замените name на ваше поле --}}
                            <td><strong>{{ $item->KursClasses->number }}</strong></td> {{-- Замените name на ваше поле --}}
                            <td>{{ Str::limit($item->topic, 50) }}</td> 
                            <td>{{ Str::limit($item->description, 50) }}</td> {{-- Замените description на ваше поле --}}
                            <td class="text-end">
                                <a href="{{ route('admin.kurs.kursAEdit', $item->id) }}" class="btn btn-sm btn-info text-white">Edit</a>
                                <form action="{{route('admin.kurs.destroy', $item->id)}}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Удалить?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Курсов пока нет</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
