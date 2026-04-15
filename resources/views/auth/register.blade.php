@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header-nav')
<nav>
    <a class="header-nav__button" href="/login">login</a>
</nav>
@endsection

@section('content')
<div class="register-content">
    <div class="register-header">
        <h2>Register</h2>
    </div>

    <div class="register-form-inner">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">お名前</label>
                <div class="form-input">
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="例: 山田　太郎">
                </div>
                @error('name')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">メールアドレス</label>
                <div class="form-input">
                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="例: test@example.com">
                </div>
                @error('email')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <div class="form-input">
                    <input type="password" name="password" id="password" placeholder="例: coachtech1106">
                </div>
                @error('password')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-btn">
                <button type="submit" class="btn-register">登録</button>
            </div>
        </form>
    </div>
</div>
@endsection
