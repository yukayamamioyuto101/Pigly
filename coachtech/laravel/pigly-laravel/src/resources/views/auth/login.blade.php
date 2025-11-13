@extends('layout.app')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h1 class="title-main">PiGly</h1>
    <h2 class="title-sub">ログイン</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

       {{-- メール --}}
<div class="form-group">
    <label for="email" class="block mb-1 font-medium">メールアドレス</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full border rounded px-2 py-1">
    @error('email')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

{{-- パスワード --}}
<div class="form-group">
    <label for="password" class="block mb-1 font-medium">パスワード</label>
    <input id="password" type="password" name="password" class="w-full border rounded px-2 py-1">
    @error('password')
        <p class="error">{{ $message }}</p>
    @enderror
</div>

        {{-- 送信ボタン --}}
        <div class="button">
            <button type="submit"
                class="button-submit">
                ログイン
            </button>
        </div>
      </form>

        <div class="login">
            <a href="{{ route('register.step1') }}" class="login-button">アカウント作成はこちら</a>
        </div>
</div>
@endsection
