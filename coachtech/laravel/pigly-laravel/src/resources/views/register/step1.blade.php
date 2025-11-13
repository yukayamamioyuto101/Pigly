{{-- resources/views/auth/register/step1.blade.php --}}

@extends('layout.app')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/step1.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h1 class="title-main">PiGly</h1>
    <h2 class="title-sub">新規会員登録</h2>
    <p class="text">STEP1 アカウント情報の登録</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- 名前 --}}
        <div class="form-group">
            <label for="name" class="block mb-1 font-medium">お名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" class="w-full ">

            @error('name')
    　　　　<p class="error">{{ $message }}</p>
　　　　　　 @enderror

        </div>

        {{-- メール --}}
        <div class="form-group">
            <label for="email" class="block mb-1 font-medium">メールアドレス</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" class="w-full ">
            @error('email')
             <p class="error">{{ $message }}</p>
            @enderror

        </div>

        {{-- パスワード --}}
        <div class="form-group">
            <label for="password" class="block mb-1 font-medium">パスワード</label>
            <input id="password" type="password" name="password" 
                class="w-full">
            @error('password')
             <p class="error">{{ $message }}</p>
            @enderror
        </div>

        {{-- 登録ボタン --}}
        <div class="button">
            <button type="submit"
                class="button-submit">
                次に進む
            </button>
        </div>
      </form>

        <div class="login">
            <a href="{{ route('login') }}" class="login-button">ログインはこちら</a>
        </div>
</div>
@endsection
