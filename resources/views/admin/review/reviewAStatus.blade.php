@extends('admin.home.admin_layout')
@section('title', 'Изменение статуса заявки')

@section('content')

<h2>Изменение статуса заявки</h2>

<p>Имя пользователя: {{ $reviews->ReviewUser->FIO }}</p>
<p>Предмет: {{ $reviews->ReviewSche->ScheItem->name_t }}</p>
<p>Оценка: {{ $reviews->rang  }} год</p>
<p>Отзыв: {{ $reviews->text}}</p>
<form method="POST" action="{{ route('admin.review.updateStatus', $reviews->id) }}">
    @csrf
    <label for="status">Статус:</label>
    <select name="status" id="status" class="form-control">
        <option value="принять" @if($reviews->status=='принять') selected @endif>принять</option>
        <option value="отклонить" @if($reviews->status=='отклонить') selected @endif>отклонить</option>
    </select>
    <button class="btn btn-primary mt-3" type="submit">Обновить статус</button>
</form>

@endsection
