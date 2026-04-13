@extends('layouts.app')

@section('content')
<div class="login-content">
    <div class="login-header">
        <h2>Login</h2>
    </div>

    <div class="login-form-inner">
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <div class="form-input">
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="test@example.com">
                </div>
                @error('email')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">パスワード</label>
                <div class="form-input">
                    <input type="password" name="password" id="password" placeholder="coachtech1106">
                </div>
                @error('password')
                <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            @error('login_error')
                <p class="error-message">{{ $message }}</p>
            @enderror

            <div class="form-btn">
                <button type="submit" class="btn-login">ログイン</button>
            </div>
        </form>
    </div>
</div>
@endsection
