<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterStepController;
use App\Http\Controllers\WeightController;
// 


Route::middleware('guest')->group(function () {
    // STEP1: アカウント登録フォーム
    Route::get('/register/step1', [RegisterStepController::class, 'step1'])
        ->name('register.step1');

    // Fortify による POST /register はそのまま使用
});  

Route::middleware('auth')->group(function () {

    // STEP2: 初回体重登録フォーム
    Route::get('/register/step2', [RegisterStepController::class, 'step2'])
        ->name('register.step2');

    Route::post('/register/step2', [RegisterStepController::class, 'store'])
        ->name('register.step2.store');

    // ✅ 体重ログ一覧
    Route::get('/weight_logs', [WeightController::class, 'index'])->name('weight.index');

    // ✅ 体重ログ登録
    Route::post('/weight/store', [WeightController::class, 'store'])->name('weight.store');

    // ✅ 目標体重設定・更新
    Route::get('/weight/goal', [WeightController::class, 'goal'])->name('weight.goal');
    Route::post('/weight/goal', [WeightController::class, 'updateGoal'])->name('weight.goal.update');

    // ✅ 詳細・編集・削除
    Route::get('/weight/{id}', [WeightController::class, 'show'])->name('weight.show');
    Route::post('/weight/{id}/update', [WeightController::class, 'update'])->name('weight.update');
    Route::delete('/weight/{id}/destroy', [WeightController::class, 'destroy'])->name('weight.destroy');

    Route::get('/', function () {
    return redirect()->route('login'); // もしくは welcomeページなど
});

});