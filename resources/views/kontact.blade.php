@extends('layouts.layout')

@section('title', 'Главная')
@section('content')

<!-- Секция контактов -->
<section class="container my-5">
    <div class="row">
        <!-- Левая колонка: Текст и данные -->
        <div class="col-lg-5 mb-5">
            <h1 class="display-4 mb-4">Контакты</h1>
            <p class="lead text-muted mb-5">
                Наша команда всегда готова ответить на ваши вопросы, помочь с выбором образовательной программы или обсудить варианты сотрудничества. Выберите наиболее удобный для вас канал связи.
            </p>

            <div class="contact-details">
                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 fs-3">📞</div>
                    <div>
                        <h5 class="mb-1">Телефонная линия</h5>
                        <p class="text-muted mb-0">+7 (495) 123-45-67</p>
                        <small class="text-secondary">Пн–Пт: 09:00 — 21:00 (МСК)</small>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 fs-3">📧</div>
                    <div>
                        <h5 class="mb-1">Электронная почта</h5>
                        <p class="text-muted mb-0">info@5plus-online.ru</p>
                        <small class="text-secondary">Отвечаем в течение 15 минут</small>
                    </div>
                </div>

                <div class="d-flex align-items-start mb-4">
                    <div class="me-3 fs-3">📍</div>
                    <div>
                        <h5 class="mb-1">Адрес</h5>
                        <p class="text-muted mb-0">г. Челбинск, ул. Гагарина, 7</p>
                    </div>
                </div>
            </div>
               </div>

        <!-- Правая колонка: Карта (на мобильных будет под текстом) -->
        <div class="col-lg-7">
            <div class="rounded-3 overflow-hidden shadow-lg" style="height: 500px;">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1862.8863694252545!2d61.44357726170838!3d55.143507479858535!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x43c5f2a5350307f3%3A0x8ca910620d48c42d!2z0J_QvtC70LjRgtC10YXQvdC40YfQtdGB0LrQuNC5INC60L7QvNC_0LvQtdC60YEg0K7QttC90L4t0KPRgNCw0LvRjNGB0LrQvtCz0L4g0LPQvtGB0YPQtNCw0YDRgdGC0LLQtdC90L3QvtCz0L4g0YLQtdGF0L3QuNGH0LXRgdC60L7Qs9C-INC60L7Qu9C70LXQtNC20LA!5e0!3m2!1sru!2sru!4v1780515627359!5m2!1sru!2sru" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
</section>


@endsection