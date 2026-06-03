@extends('layouts.layout')

@section('title', 'Главная')

@section('content')
    <!-- Слайдер -->
    <div id="mainCarousel" class="carousel slide **w-75 mx-auto** m-5" data-bs-ride="carousel">
        <div class="carousel-inner">
            <!-- Первый слайд -->
            <div class="carousel-item active">
                <img src="{{ asset('assets/img/sliders/ab443265a9a11f184380ecc3ac7b6ac_1.jpeg') }}"
                    class="d-block w-70 mx-auto" alt="Первый слайд">
            </div>
            <!-- Второй слайд -->
            <div class="carousel-item">
                <img src="{{ asset('assets/img/sliders/b72aa7e5a9911f19739dedad3e518de_1.jpeg') }}"
                    class="d-block w-70 mx-auto" alt="Второй слайд">
            </div>
            <!-- Третий слайд -->
            <div class="carousel-item">
                <img src="{{ asset('assets/img/sliders/ffac1205d9c11f1a981a6ad5404c5f2_2.jpeg') }}"
                    class="d-block w-70 mx-auto" alt="Третий слайд">
            </div>
        </div>
        <!-- Навигационные стрелки -->
        <button class="carousel-control-prev" type="button" data-bs-target="#mainCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#mainCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <div class="container my-5">
        <div class="text-center mb-5">
            <div class="mx-auto mt-3" style="width: 50px; height: 4px; background-color: #0d6efd; border-radius: 2px;">
            </div>
            <h1 class="display-4 fw-bold text-dark">О нашей платформе</h1>
            <div class="mx-auto mt-3" style="width: 50px; height: 4px; background-color: #0d6efd; border-radius: 2px;">
            </div>
        </div>

        <!-- Блок 1: Миссия и концепция -->
        <div class="row align-items-center mb-5">
            <div class="col-md-6 text-center">
                <img src="{{ asset('assets/img/кот1.jfif') }}" alt="Миссия компании" class="img-fluid rounded shadow-sm"
                    style="max-width: 400px;">
            </div>
            <div class="col-md-6">
                <h2 class="h3 mb-4">Наша философия и миссия</h2>
                <p class="lead">
                    Добро пожаловать в образовательную экосистему <strong>&laquo;5+ Онлайн&raquo;</strong> — современное
                    технологичное пространство, созданное для обеспечения доступности высококачественного обучения в
                    цифровой среде.
                </p>
                <p>
                    В основе нашей деятельности лежит стремление к преодолению образовательных барьеров. Мы не просто
                    предоставляем доступ к урокам, мы выстраиваем комплексную систему взаимодействия между учеником и
                    наставником. Наша платформа аккумулирует базу преподавателей с подтверждённой академической
                    квалификацией, что позволяет гарантировать высокий уровень подготовки по широкому спектру дисциплин.
                </p>
                <p>
                    Мы глубоко убеждены, что образование должно отвечать не только текущим академическим стандартам, но и
                    динамично меняющимся требованиям современного законодательства и рынка труда. Наша миссия —
                    способствовать формированию устойчивых когнитивных навыков и системных знаний, которые станут
                    фундаментом для профессионального и личностного роста каждого студента.
                </p>
            </div>
        </div>

        <!-- Блок 2: Преимущества (с расширенным описанием) -->
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="h3 mb-4 text-center text-md-start">Ключевые компетенции и преимущества</h2>
                    <p class="text-muted mb-4">Почему профессиональное сообщество выбирает именно нас:</p>

                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <strong><i class="bi bi-check-circle-fill text-primary"></i> Персонализированная образовательная
                                траектория:</strong>
                            В отличие от стандартизированных программ, мы внедряем индивидуальный подход, где учебный план
                            адаптируется под уникальные психофизиологические особенности и текущий уровень знаний каждого
                            обучающегося.
                        </li>
                        <li class="mb-3">
                            <strong><i class="bi bi-check-circle-fill text-primary"></i> Мультимодальность
                                обучения:</strong>
                            Мы предлагаем широкий спектр форматов — от классических дистанционных онлайн-занятий до
                            гибридных моделей, обеспечивая гибкость в выборе инструментов освоения материала.
                        </li>
                        <li class="mb-3">
                            <strong><i class="bi bi-check-circle-fill text-primary"></i> Гарантия академической
                                чистоты:</strong>
                            Процесс подбора кадров включает многоступенчатую верификацию. Все наши педагоги имеют профильное
                            высшее образование и строго соблюдают этические и правовые нормы образовательной деятельности.
                        </li>
                        <li class="mb-3">
                            <strong><i class="bi bi-check-circle-fill text-primary"></i> Инновационный
                                инструментарий:</strong>
                            Использование современных интерактивных методик и цифровых технологий позволяет повысить
                            вовлеченность студентов и значительно ускорить процесс усвоения сложных концепций.
                        </li>
                        <li class="mb-3">
                            <strong><i class="bi bi-check-circle-fill text-primary"></i> Комплексное сопровождение:</strong>
                            Наша поддержка не ограничивается рамками учебного часа. Мы осуществляем менторское
                            сопровождение, помогая преодолевать академические трудности и поддерживая мотивацию на
                            протяжении всего курса.
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-center">
                    <img src="{{ asset('assets/img/cat.jfif') }}" alt="Преимущества платформы"
                        class="img-fluid rounded shadow-sm" style="max-width: 80%;">
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <div class="mx-auto mt-3" style="width: 50px; height: 4px; background-color: #0d6efd; border-radius: 2px;"></div>
        <h1 class="display-4 fw-bold text-dark">Наши Преподаватели</h1>
        <p class="text-muted fs-5">Профессионалы, которые помогут вам достичь новых высот</p>
        <div class="mx-auto mt-3" style="width: 50px; height: 4px; background-color: #0d6efd; border-radius: 2px;"></div>
    </div>

    <div class="row align-items-center mb-5 justify-content-center p-5 m-5">
        @forelse($teachers as $teacher)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100 border-0 shadow-sm teacher-card">
                    <!-- Контейнер для фото с эффектом -->
                    <div class="teacher-photo-wrapper">
                        @if ($teacher->photo)
                            <img src="{{ asset('assets/img/' . $teacher->photo) }}" class="card-img-top"
                                alt="{{ $teacher->TutorUser->FIO }}">
                        @else
                            <img src="{{ asset('images/default-avatar.png') }}" class="card-img-top" alt="No photo">
                        @endif
                        <!-- Бейдж с предметом поверх фото (опционально) -->
                        <div class="photo-overlay">
                            <span class="badge bg-white text-dark shadow-sm px-3 py-2">
                                {{ $teacher->TutorItem->name_t }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body d-flex flex-column p-4">
                        <div class="text-center mb-3">
                            <h4 class="card-title fw-bold mb-1 text-dark">{{ $teacher->TutorUser->FIO }}</h4>
                            <div class="text-primary small fw-semibold">
                                <i class="bi bi-mortarboard-fill me-1"></i> Эксперт
                            </div>
                        </div>

                        <hr class="my-3 opacity-25">

                        <div class="teacher-info">
                            <div class="d-flex align-items-center mb-2">
                                <div class="icon-box me-3">
                                    <i class="bi bi-book text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Предмет</small>
                                    <span class="fw-medium">{{ $teacher->TutorItem->name_t }}</span>
                                </div>
                            </div>

                            <div class="d-flex align-items-center mb-2">
                                <div class="icon-box me-3">
                                    <i class="bi bi-award text-primary"></i>
                                </div>
                                <div>
                                    <small class="text-muted d-block">Стаж</small>
                                    <span class="fw-medium">{{ $teacher->experience }} лет опыта</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="mb-3">
                    <i class="bi bi-people text-muted" style="font-size: 4rem;"></i>
                </div>
                <h3 class="text-muted">Преподаватели пока не добавлены.</h3>
                <p>Заходите позже или свяжитесь с нами.</p>
            </div>
        @endforelse
    </div>

    <section class="container my-5">
        <div class="row">
            <!-- Левая колонка: Текст и данные -->
            <div class="col-lg-5 mb-5">
                <h1 class="display-4 mb-4">Контакты</h1>
                <p class="lead text-muted mb-5">
                    Наша команда всегда готова ответить на ваши вопросы, помочь с выбором образовательной программы или
                    обсудить варианты сотрудничества. Выберите наиболее удобный для вас канал связи.
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
@endsection
