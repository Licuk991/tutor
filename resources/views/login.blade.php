
@extends('layouts.layout')

@section('title', 'Авторизация')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-4"> <!-- Сделал колонку уже, для входа это лучше -->
            
            <!-- Карточка авторизации -->
            <div class="card border-0 shadow-lg" style="border-radius: 20px;">
                
                <!-- Шапка -->
                <div class="card-header bg-primary text-white text-center py-4 border-0" style="border-radius: 20px 20px 0 0;">
                    <h2 class="fw-bold mb-0">Вход в систему</h2>
                    <p class="small opacity-75 mb-0">Введите свои данные для доступа</p>
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

                    <form action="{{ route('storeLogin') }}" method="post">
                        @csrf

                        <!-- Логин -->
                        <div class="mb-4">
                            <label for="login" class="form-label fw-semibold">Логин</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-person"></i></span>
                                <input type="text" name="login" class="form-control bg-light border-start-0" id="login" 
                                       required placeholder="Ваш логин">
                            </div>
                        </div>

                        <!-- Пароль -->
                        <div class="mb-4">
                            <label for="password" class="form-label fw-semibold">Пароль</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock"></i></span>
                                <input type="password" name="password" class="form-control bg-light border-start-0" id="password" 
                                       required placeholder="••••••••">
                                                                  </div>
                        </div>

                        <!-- Кнопка входа -->
                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-primary btn-lg shadow-sm fw-bold">
                                Авторизоваться
                            </button>
                        </div>

                        <!-- Ссылка на регистрацию -->
                        <div class="text-center">
                            <p class="small text-muted mb-0">
                                Еще нет аккаунта? 
                                <a href="{{ route('register') }}" class="text-primary fw-bold text-decoration-none">Зарегистрироваться</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Ссылка на главную или назад -->
            <div class="text-center mt-4">
                <a href="/" class="text-muted text-decoration-none small">
                    <i class="bi bi-arrow-left"></i> Вернуться на главную
                </a>
            </div>

        </div>
    </div>
</div>

@endsection
