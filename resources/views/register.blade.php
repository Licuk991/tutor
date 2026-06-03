@extends('layouts.layout')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-5">

                <!-- Карточка регистрации -->
                <div class="card border-0 shadow-lg overflow-hidden" style="border-radius: 20px;">

                    <!-- Шапка карточки -->
                    <div class="card-header bg-primary text-white text-center py-4 border-0">
                        <h2 class="fw-bold mb-0">Создать аккаунт</h2>
                        <p class="small opacity-75 mb-0">Присоединяйтесь к нашему сообществу</p>
                    </div>

                    <div class="card-body p-4 p-md-5">

                        <!-- Блок ошибок -->
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm mb-4">
                                <ul class="mb-0 ps-3 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success border-0 shadow-sm mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('storeRegister') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- Основные данные -->
                            <div class="mb-4">
                                <label for="FIO" class="form-label fw-semibold">ФИО</label>
                                <input type="text" name="FIO" class="form-control form-control-lg fs-6"
                                    id="FIO" required placeholder="Иванов Иван Иванович">
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label for="login" class="form-label fw-semibold">Логин</label>
                                    <input type="text" name="login" class="form-control" id="login" required
                                        placeholder="user123">
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" required
                                        placeholder="example@mail.ru">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">Пароль</label>
                                <input id="password" type="password" class="form-control" name="password" minlength="6"
                                    required placeholder="••••••••">
                                <div class="form-text text-muted">Минимум 6 символов</div>
                            </div>

                            <!-- Выбор роли (Красивые переключатели) -->
                            <div class="mb-4">
                                <label class="form-label fw-bold d-block mb-3 text-center">Я регистрируюсь как:</label>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="role" id="role_user" value="user"
                                            checked autocomplete="off">
                                        <label class="btn btn-outline-primary w-100 py-2 role-btn" for="role_user">
                                            <i class="bi bi-person d-block fs-4 mb-1"></i> Ученик
                                        </label>
                                    </div>
                                    <div class="col-6">
                                        <input type="radio" class="btn-check" name="role" id="role_teacher"
                                            value="teacher" autocomplete="off">
                                        <label class="btn btn-outline-primary w-100 py-2 role-btn" for="role_teacher">
                                            <i class="bi bi-mortarboard d-block fs-4 mb-1"></i> Учитель
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <!-- Поля учителя (Анимированный блок) -->
                            <div id="teacher_fields" class="bg-light p-3 rounded-3 mb-4" style="display: none;">
                                <div class="row">
                                    <!-- Опыт -->
                                    <div class="col-md-4 mb-3">
                                        <label for="experience" class="form-label small fw-bold">Опыт (лет)</label>
                                        <input type="number" name="experience" id="experience" class="form-control"
                                            min="0">
                                    </div>

                                    <!-- Предмет -->
                                    <div class="col-md-4 mb-3">
                                        <label for="item_id" class="form-label small fw-bold">Предмет</label>
                                        <select name="item_id" id="item_id" class="form-select">
                                            <option value="">Выбрать...</option>
                                            @foreach ($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name_t }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Фотография -->
                                    <div class="col-md-4 mb-3">
                                        <label for="photo" class="form-label small fw-bold">Фотография профиля</label>
                                        <input type="file" name="photo" id="photo" class="form-control"
                                            accept="image/*">
                                        <div class="form-text" style="font-size: 0.75rem;">Рекомендуемый формат: JPG, PNG
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <!-- Согласие -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" name="rules" id="rules" required>
                                <label class="form-check-label small text-muted" for="rules">
                                    Я согласен с <a href="#" class="text-decoration-none">правилами регистрации</a>
                                </label>
                            </div>

                            <!-- Кнопка -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold">
                                    Зарегистрироваться
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="text-muted">Уже есть аккаунт? <a href="{{ route('login') }}"
                            class="text-primary fw-bold text-decoration-none">Войти</a></p>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('input[name="role"]').forEach((elem) => {
            elem.addEventListener('change', function(event) {
                const teacherFields = document.getElementById('teacher_fields');
                const experienceInput = document.getElementById('experience');
                const itemSelect = document.getElementById('item_id');

                if (event.target.id === 'role_teacher') {
                    teacherFields.style.display = 'block';
                    experienceInput.setAttribute('required', 'required');
                    itemSelect.setAttribute('required', 'required');
                } else {
                    teacherFields.style.display = 'none';
                    experienceInput.removeAttribute('required');
                    itemSelect.removeAttribute('required');
                }
            });
        });
    </script>
@endsection
