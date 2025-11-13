@extends('layout.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
{{-- ヘッダー --}}
<div class="header">
    <div class="header-inner">
        <h1 class="header-inner-logo">PiGLy</h1>
        <div class="actions">
            <a href="{{ route('weight.goal') }}" class="action-btn">
             <i class="fas fa-cog"></i>目標体重設定</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="action-btn">
                <i class="fas fa-sign-out-alt"></i>ログアウト</button>
            </form>
        </div>
    </div>
</div>

{{-- 目標・最新体重 --}}
<div class="goal-summary">
    <div class="text-center">
        <div class="text-content">目標体重</div>
        <div class="text-2xl">{{ $weightTarget->target_weight ?? '-' }} kg</div>
    </div>
    <div class="text-center">
        <div class="text-content">目標まで</div>
        <div class="text-2xl">{{ $diffWeight ?? '-' }} kg</div>
    </div>
    <div class="text-center">
        <div class="text-content">最新体重</div>
        <div class="text-2xl">{{ $latestWeight->weight ?? '-' }} kg</div>
    </div>
</div>

{{-- 検索 + データ追加ボタン --}}
<div class="buttons">
    <form method="GET" action="{{ route('weight.index') }}" class="date-search-form">
        <input type="date" name="from" value="{{ request('from') }}" class="date-input">
        <input type="date" name="to" value="{{ request('to') }}" class="date-input">
        <button type="submit" class="search-btn">検索</button>
    </form>

    <div id="button-container">
        <button id="openModal">データ追加</button>
    </div>
</div>

{{-- 体重データ一覧 --}}
<div class="container">
    <table class="weight-logs">
        <thead>
            <tr>
                <th>日付</th>
                <th>体重</th>
                <th>摂取カロリー</th>
                <th>運動時間</th>
                <th>詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach($weightLogs as $log)
            <tr>
                <td>{{ $log->date->format('Y/m/d') }}</td>
                <td>{{ $log->weight }} kg</td>
                <td>{{ $log->calories }} cal</td>
                <td>{{ floor($log->exercise_time / 60) }}:{{ str_pad($log->exercise_time % 60, 2, '0', STR_PAD_LEFT) }}</td>
                <td>
                    <a href="{{ route('weight.show', $log->id) }}">✏️</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- ページネーション --}}
<div class="mt-4">
    {{ $weightLogs->links() }}
</div>

{{-- モーダル（フォームのみ） --}}
<div id="dataModal"class="{{ $errors->any() ? 'active' : '' }}">
    <div id="modalContent">
        <h1>新規登録</h1>
        <form method="POST" action="{{ route('weight.store') }}">
            @csrf

            <div class="weitlog-title">
                <label for="date">日付</label>
                <p class="required-content">必須</p>
            </div>
            <input type="date" name="date" id="date"value="{{ old('date') }}">
            @error('date') <p class="error">{{ $message }}</p> @enderror

            <div class="weitlog-title">
                <label for="weight">体重</label>
                <p class="required-content">必須</p>
            </div>
            <input type="number" name="weight" id="weight" step="0.1"value="{{ old('weight') }}">
            @error('weight') <p class="error">{{ $message }}</p> @enderror

            <div class="weitlog-title">
                <label for="calories">摂取カロリー</label>
                <p class="required-content">必須</p>
            </div>
            <input type="number" name="calories" id="calories" step="0.1"value="{{ old('calories') }}">
            @error('calories') <p class="error">{{ $message }}</p> @enderror

            <div class="weitlog-title">
                <label for="exercise_hours">運動時間</label>
                <p class="required-content">必須</p>
            </div>
            <div class="time">
             <input type="number" name="exercise_hours" id="exercise_hours" min="0" placeholder="時間"
           value="{{ old('exercise_hours') }}">
            <input type="number" name="exercise_minutes" id="exercise_minutes" min="0" max="59" placeholder="分"
           value="{{ old('exercise_minutes') }}">
</div>
            @error('exercise_hours') <p class="error">{{ $message }}</p> @enderror
            @error('exercise_minutes') <p class="error">{{ $message }}</p> @enderror

            <div class="weitlog-title">
                <label for="exercise_content">運動内容</label>
                <p class="required-content">必須</p>
            </div>
            <input type="text" name="exercise_content" id="exercise_content"value="{{ old('exercise_content') }}">
            @error('exercise_content') <p class="error">{{ $message }}</p> @enderror

            <button type="submit">登録</button>
        </form>
        <button type="button" id="modalBack">戻る</button>
    </div>
</div>
@endsection

@section('js')
<script>
const openBtn = document.getElementById('openModal');
const backBtn = document.getElementById('modalBack');
const modal = document.getElementById('dataModal');

// モーダルを開く
openBtn.addEventListener('click', () => {
    // フォームをリセットしてバリデーションエラーを消す
    const form = modal.querySelector('form');
    form.reset();

    // エラーメッセージも消す
    modal.querySelectorAll('.error').forEach(el => el.textContent = '');

    modal.classList.add('active');
});

backBtn.addEventListener('click', () => modal.classList.remove('active'));
window.addEventListener('click', (e) => { if(e.target === modal) modal.classList.remove('active'); });
</script>
@endsection
