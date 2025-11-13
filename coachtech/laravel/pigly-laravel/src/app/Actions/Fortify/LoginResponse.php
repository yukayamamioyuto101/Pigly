<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements LoginResponseContract
{
    /**
     * Handle the response after a successful login.
     */
    public function toResponse($request)
    {
        $user = Auth::user();

        // 新規登録直後で STEP2 が未入力なら STEP2 にリダイレクト
        if (!$user->weightLogs()->exists() || !$user->weightTarget()->exists()) {
            return redirect()->route('register.step2');
        }

        // 体重ログや目標体重が既にある場合は INDEX へ
        return redirect()->route('weight.index');
    }
}
