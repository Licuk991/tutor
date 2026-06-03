@extends('admin.home.admin_layout')
@section('title', 'Изменение статуса заявки')

@section('content')

<h2>Изменение статуса заявки</h2>

<p>Имя: {{ $schedules->ScheUser->FIO }}</p>
<p>Класс: {{ $schedules->ScheClasses->number }}</p>
<p>Предмет: {{ $schedules->ScheItem->name_t  }} год</p>
<p>Дата: {{ $schedules->date}}</p>
<form method="POST" action="{{ route('admin.schedule.updateStatus', $schedules->id) }}">
    @csrf
    <label for="status">Статус:</label>
    <select name="status" id="status" class="form-control">
        <option value="идет курс" @if($schedules->status=='идет курс') selected @endif>идет курс</option>
        <option value="курс завершен" @if($schedules->status=='курс завершен') selected @endif>курс завершен</option>
    </select>
    <button class="btn btn-primary mt-3" type="submit">Обновить статус</button>
</form>

@endsection
