
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- Добавим Bootstrap Icons для красоты -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>@yield('title')</title>
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-bg: #1e293b; /* Глубокий синий/серый */
            --sidebar-hover: #334155;
            --accent-color: #3b82f6; /* Яркий синий */
        }

        body, html {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Предотвращает двойную прокрутку */
        }

        .wrapper {
            display: flex;
            height: 100vh;
            width: 100vw;
        }

        /* Sidebar стили */
        #sidebar {
            width: var(--sidebar-width);
            min-width: var(--sidebar-width);
            background-color: var(--sidebar-bg);
            color: white;
            display: flex;
            flex-direction: column;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 2rem 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        #sidebar .nav {
            padding: 1rem 0;
        }

        #sidebar .nav-link {
            color: #cbd5e1;
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px; /* Отступ для иконок */
            font-size: 1rem;
            transition: 0.2s;
        }

        #sidebar .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: white;
        }

        #sidebar .nav-link.active {
            background-color: var(--accent-color);
            color: white;
            border-radius: 0 25px 25px 0; /* Красивый скругленный край */
            margin-right: 10px;
        }

        #sidebar .nav-link i {
            font-size: 1.2rem;
        }

        /* Контент стили */
        #content {
            flex-grow: 1; /* Занимает всё оставшееся место */
            overflow-y: auto; /* Прокрутка только внутри контента */
            background-color: #f1f5f9;
            padding: 2rem;
        }

        /* Адаптивность для планшетов и мобилок */
        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column;
            }
            #sidebar {
                width: 100%;
                min-width: 100%;
                height: auto;
            }
            #sidebar .nav-link.active {
                border-radius: 0;
                margin-right: 0;
            }
            #content {
                height: auto;
            }
        }
    </style>
</head>
<body>

<div class="wrapper">
    <!-- Боковая панель -->
    <nav id="sidebar" class="d-flex flex-column">
        <div class="sidebar-header">
            <a href="{{ route('admin.home.admin') }}">
               <img src="{{ asset('assets/img/814a23075f8e11f18556eaee102575c0_1.jfif') }}" alt="logo" class="navbar-logo logo rounded-circle border" style="width: 90px; height: 85px; object-fit: cover;">
            </a>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('admin.kurs.kursA') }}" class="nav-link">
                    <i class="bi bi-book"></i> Курсы
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.item.itemA') }}" class="nav-link">
                    <i class="bi bi-book"></i> Предметы
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tutor.tutorA') }}" class="nav-link">
                    <i class="bi bi-clipboard-data"></i> Заявки репетиторства
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.schedule.scheduleA') }}" class="nav-link">
                    <i class="bi bi-person-check"></i> Запись студентов
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.review.reviewA') }}" class="nav-link">
                    <i class="bi bi-chat-left-text"></i> Отзывы
                </a>
            </li>
            <hr>
             <li class="nav-item">
                <a href="{{ route('logout') }}" class="nav-link">
                    <i class="bi bi-chat-left-text"></i> Выйти
                </a>
            </li>
        </ul>
    </nav>

    <!-- Основной контент -->
    <div id="content">
        <main>
            <div class="container-fluid">
                @yield('content')
            </div>
        </main>
    </div>
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.js') }}"></script>
</body>
</html>
