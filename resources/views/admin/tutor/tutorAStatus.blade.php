@extends('admin.home.admin_layout')
@section('title', 'Изменение статуса заявки')

@section('content')

<h2>Изменение статуса заявки</h2>

<p>Имя: {{ $application->TutorUser->FIO }}</p>
<p>Email: {{ $application->TutorUser->email }}</p>
<p>Опыт работы: {{ $application->experience }} год</p>
<p>Предмет: {{ $application->TutorItem->name_t }}</p>
<form method="POST" action="{{ route('admin.tutor.updateStatus', $application->id) }}">
    @csrf
    <label for="status">Статус:</label>
    <select name="status" id="status" class="form-control">
        <option value="принять" @if($application->status=='принять') selected @endif>Принять</option>
        <option value="отклонить" @if($application->status=='отклонить') selected @endif>Отклонить</option>
    </select>
    <button class="btn btn-primary mt-3" type="submit">Обновить статус</button>
</form>

@endsection
