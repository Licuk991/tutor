<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-grid.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" sizes="32x32" href="{{ asset('assets/img/814a23075f8e11f18556eaee102575c0_1.jfif') }}">
    <title>@yield('title')</title>
</head>
<body>
    <main>
            
<header id="main-header">
    <nav class="navbar navbar-expand-lg navbar-dark"> <!-- Изменено на navbar-dark -->
        <div class="container">
            <a href="/" class="navbar-brand">
                <img src="{{ asset('assets/img/814a23075f8e11f18556eaee102575c0_1.jfif') }}" alt="logo" class="navbar-logo logo rounded-circle border" style="width: 90px; height: 85px; object-fit: cover;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a href="/about" class="nav-link">О нас</a></li>
                    <li class="nav-item"><a href="/kurs" class="nav-link">Курс</a></li>
                    <li class="nav-item"><a href="/kontact" class="nav-link">Контакты</a></li>
                    <li class="nav-item"><a href="/review" class="nav-link">Отзывы</a></li>
                    <li class="nav-item"><a href="/teacher" class="nav-link">Учителя</a></li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <li class="nav-item"><a href="/admin" class="nav-link">Админ панель</a></li>
                            <li class="nav-item"><a href="/" class="nav-link">На сайт</a></li>
                            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link logout-link">Выйти</a></li>
                        @elseif(Auth::user()->role === 'teacher')
                            <li class="nav-item"><a href="{{ route('profileT') }}" class="nav-link">Профиль</a></li>
                            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link logout-link">Выйти</a></li>
                        @elseif(Auth::user()->role === 'user')
                            <li class="nav-item"><a href="/zapiz" class="nav-link">Записаться</a></li>
                            <li class="nav-item"><a href="/schedule" class="nav-link">Расписание</a></li>
                            <li class="nav-item"><a href="{{ route('logout') }}" class="nav-link logout-link">Выйти</a></li>
                        @endif
                    @endauth
                    @guest
                        <li class="nav-item"><a href="/login" class="nav-link">Войти</a></li>
                        <li class="nav-item"><a href="/register" class="btn btn-outline-light ms-lg-2">Регистрация</a></li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
        </header>

        <div class="conatiner">
            @yield('content')
        </div>
    </main>

    
<footer class="footer-section text-white">
    <div class="container">
        <div class="row gy-4">
            <!-- Колонка 1: О компании -->
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title">Наша Компания</h5>
                <p class="footer-text">
                    Мы предлагаем инновационные решения для вашего обучения. Качество и надежность — наши главные приоритеты в репетиторстве.
                </p>
                <div class="social-links">
                    <a href="https://vk.com/"><i class="bi bi-telegram"></i></a>
                    <a href="https://rutube.ru/"><i class="bi bi-youtube"></i></a>
                    <a href="https://web.telegram.org/"><i class="bi bi-telegram"></i></a>
                </div>
            </div>

            <!-- Колонка 2: Быстрые ссылки -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Навигация</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/about">О нас</a></li>
                    <li><a href="/kurs">Курс</a></li>
                    <li><a href="/kontact">Контакты</a></li>
                    <li><a href="/review">Отзывы</a></li>
                    <li><a href="/teacher">Учителя</a></li>
                </ul>
            </div>

            <!-- Колонка 3: Полезные ссылки -->
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-title">Поддержка</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="https://mail.yandex.ru/">Помощь</a></li>
                    <li><a href="/polcon">Политика конфиденциальности</a></li>
                </ul>
            </div>

            <!-- Колонка 4: Контакты -->
            <div class="col-lg-4 col-md-6">
                <h5 class="footer-title">Контакты</h5>
                <ul class="list-unstyled footer-contact">
                    <li><i class="bi bi-geo-alt"></i> г. Челябинск, ул. Гагарина, 7</li>
                    <li><i class="bi bi-envelope"></i> info@5plus-online.ru</li>
                    <li><i class="bi bi-telephone"></i> +7 (495) 123-45-67</li>
                </ul>
            </div>
        </div>

        <hr class="my-4 border-secondary">

        {{-- <-- Нижняя часть --> --}}
        <div class="row align-items-center">
            <div class="col-md-7 text-center text-md-start">
                <p class="small mb-0">&copy; 2026 Все права защищены. 5+ Онлайн</p>
            </div>
            <div class="col-md-5 text-center text-md-end">
                <p class="small mb-0">Сделано с ❤️ для вашего успеха.</p>
            </div>
        </div>
    </div>
</footer>

<!-- Подключение Bootstrap Icons (для иконок) -->
<link rel="stylesheet\" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">


    <script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
    
</body>
</html>
