@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="login__content">
    <div class="login__heading">
        <h2>Login</h2>
    </div>

    <form class="form" action="{{ route('login') }}" method="post" novalidate>
        @csrf

        <div class="form__group">
            <label class="form__label">メールアドレス</label>
            <input class="form__input" type="email" name="email" value="{{ old('email') }}" placeholder="例：test@example.com">
            @error('email')
                <p class="form__error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__group">
            <label class="form__label">パスワード</label>
            <input class="form__input" type="password" name="password" placeholder="例：coachtech1106">
            @error('password')
                <p class="form__error-message">{{ $message }}</p>
            @enderror
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">ログイン</button>
        </div>
    </form>
</div>
@endsection