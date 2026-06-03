@extends('layouts.layout')

@section('title', 'Редактировать профиль')


@section('content')
    <div class="container mt-5 m-5">
        <div class="row">
            <!-- ЛЕВАЯ КОЛОНКА: Профиль Учителя -->
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h3 class="card-title">Профиль Учителя</h3>
                        <hr>

                        <img src="{{ $teacher->photo ? asset('assets/img/' . $teacher->photo) : asset('assets/img/default-avatar.png') }}"
                            class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;"
                            alt="Профиль">


                        <p class="text-start"><strong class="text-muted">Логин:</strong> {{ $teacher->login }}</p>
                        <p class="text-start"><strong class="text-muted">Email:</strong> {{ $teacher->email }}</p>
                        <p class="text-start"><strong class="text-muted">Предмет:</strong>
                            {{ $teacher->tutorItem->name_t ?? 'Не указан' }}</p>
                        <p class="text-start"><strong class="text-muted">Опыт работы:</strong>
                            {{ $teacher->UserTurot->experience ?? 'Не указан' }}</p>
                    </div>
                </div>
            </div>

            
<!-- ПРАВАЯ КОЛОНКА: Список учеников -->

<div class="col-md-8">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="mb-0 text-dark">Записанные ученики</h4> 
        </div>
        <div class="card-body">
            {{-- Обращаемся к свойству enrolled_students --}}
            @if ($teacher->enrolled_students && $teacher->enrolled_students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Имя / Логин</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($teacher->enrolled_students as $student)
                                <tr>
                                    <td>{{ $student->login }}</td>
                                    <td>{{ $student->email }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    У этого учителя пока нет записанных учеников.
                </div>
            @endif
        </div>
    </div>
</div>


        </div>
    </div>
@endsection
