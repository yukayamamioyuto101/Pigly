@extends('layout.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
@endsection

@section('content')
{{-- ヘッダー --}}
<div class="header">
    <div class="header-inner">
        <h1 class="header-inner-logo">PiGLy</h1>
        <div class="actions">
            <a href="{{ route('weight.goal') }}" class="action-btn"><i class="fas fa-cog"></i>目標体重設定</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="action-btn"><i class="fas fa-sign-out-alt"></i>ログアウト</button>
            </form>
        </div>
    </div>
</div>

    <div class="container">
      <h1 class="title">Weight Log</h1>

        <form method="POST" action="{{ route('weight.update', $weightLog->id) }}">
            @csrf
            <label for="date">日付</label>
            <input type="date" name="date" id="date" value="{{ $weightLog->date->format('Y-m-d') }}">
            @error('date')
    　　　　<p class="error">]
           {{ $message }} 
           </p>
　　　　　　 @enderror


            <label for="weight">体重</label>
            <input type="number" name="weight" id="weight"  value="{{ $weightLog->weight }}" step="0.1">
            @error('weight')
    　　　　<p class="error">
           {{ $message }} 
           </p>
　　　　　　 @enderror

            
            <label for="calories">摂取カロリー</label>
            <input type="number" name="calories" id="calories" value="{{ $weightLog->calories }}" step="0.1">
            @error('calories')
    　　　　<p class="error">
           {{ $message }} 
           </p>
　　　　　　 @enderror


            <label for="exercise_hours">運動時間</label>
          <div class="time">
            <input type="number" name="exercise_hours" id="exercise_hours" min="0" placeholder="時間">
            <input type="number" name="exercise_minutes" id="exercise_minutes" min="0" max="59" placeholder="分">
          </div>
            @error('exercise_hours')
            <p class="error">{{ $message }}</p>
            @enderror
            @error('exercise_minutes')
            <p class="error">{{ $message }}</p>
            @enderror

            <label for="exercise_content">運動内容</label>
            <input type="text" name="exercise_content" id="exercise_content"  value="{{ $weightLog->exercise_content }}">
            @error('exercise_content')
    　　　　<p class="error">
           {{ $message }} 
           </p>
　　　　　　 @enderror

          <div class="form-buttons">
            <a href="{{route('weight.index')}}" class="form-buttons-return">戻る</a>
            <button type="submit"class="form-buttons-update">更新</button>
      </div>
    </form>

    <form action="{{ route('weight.destroy', $weightLog->id)}}" method="POST" class="inline" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">🗑️</button>
        </form>
    </div>
@endsection