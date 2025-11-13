@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/goal.css') }}">
@endsection

@section('content')
    <div class="header">
      <div class="header-inner">
           <h1 class="header-inner-logo"> PiGLy</h1>
        <div class="action">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i>ログアウト</button>
            </form>
        </div>
      </div>
    </div>
<main class="main-wrapper">
    <div class="target_weight-container">
      <h2>目標体重設定</h2>
     <form method="POST" action="{{ route('weight.goal.update') }}">
       @csrf
        <input type="number" name="target_weight" class="target_weight" value="{{ old('target_weight', $weightTarget->target_weight ?? '')}}" >
        @error('target_weight') <p class="error">{{ $message }}</p> @enderror

      <div class="buttons">
       <a href="{{ route('weight.index') }}" class="return-btn">戻る</a>
       <button type="submit" class="edit-btn">更新</button> 
      </div>    
     </form>
    </div>
    </main>