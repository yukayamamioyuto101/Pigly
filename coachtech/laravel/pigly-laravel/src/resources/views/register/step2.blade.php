{{-- resources/views/auth/register/step2.blade.php --}}

@extends('layout.app')

@section('css')
 <link rel="stylesheet" href="{{ asset('css/step2.css') }}">
@endsection

@section('content')
<div class="register-container">
    <h1 class="title-main">PiGly</h1>
    <h2 class="title-sub">新規会員登録</h2>
    <p class="text">STEP2 体重データの入力</p>

    <form method="POST" action="{{ route('register.step2.store') }}">
        @csrf
        
        <div class="form-group">
            <label for="weight" class="weight">現在の体重</label>
            <input type="number" id="weight" name="weight" value="{{ old('weight') }}" >
            @error('weight')
    　　　　<p class="error">{{ $message }}</p>
　　　　　　 @enderror
        </div>

        <div class="form-group">
            <label for="target_weight" class="target_weight">目標の体重</label>
            <input type="number" id="target_weight" name="target_weight" value="{{ old('target_weight') }}" step="0.1">
            @error('target_weight')
    　　　　<p class="error">{{ $message }}</p>
　　　　　　 @enderror
        </div>

        {{-- 送信ボタン --}}
        <div class="button">
            <button type="submit"
                class="button-submit">
                アカウント作成
            </button>
        </div>
      </form>

</div>
@endsection
