@extends('layout')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="auth-pages">
        <div class="auth-left">
            @if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
            @endif @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h2>Уже есть аккаунт</h2>
            <div class="spacer"></div>

            <form action="{{ route('login') }}" method="POST">
                {{ csrf_field() }}

                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>
                <input type="password" id="password" name="password" value="{{ old('password') }}" placeholder="Password" required>

                <div class="login-container">
                    <button type="submit" class="auth-button">Войти</button>
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Запомнить меня
                    </label>
                </div>

                <div class="spacer"></div>

                <a href="{{ route('password.request') }}">
                    Забыли пароль?
                </a>

            </form>
        </div>

        <div class="auth-right">
            <h2>Новый покупатель</h2>
            <div class="spacer"></div>
            <p><strong>Сохраните свое время</strong></p>
            <p>Вам не нужен аккаунт чтобы оформить заказ.</p>
            <div class="spacer"></div>
            <a href="{{ route('guestCheckout.index') }}" class="auth-button-hollow">Продолжить как гость</a>
            <div class="spacer"></div>
            &nbsp;
            <div class="spacer"></div>
            <p><strong>Сохраните свое время</strong></p>
            <p>Создайте аккаунт для просмотра истории заказов</p>
            <div class="spacer"></div>
            <a href="{{ route('register') }}" class="auth-button-hollow">Создать аккаунт</a>

        </div>
    </div>
</div>
@endsection
