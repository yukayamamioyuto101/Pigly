<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;
use App\Actions\Fortify\CustomRegisterResponse;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }     

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 登録時のユーザー作成処理
        Fortify::createUsersUsing(CreateNewUser::class);

        // ✅ 登録ページ（STEP1）
        Fortify::registerView(function () {
            return view('register.step1');
        });

        // ✅ ログインページ
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ✅ ログイン回数制限
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(10)->by($email . $request->ip());
        });
        
        $this->app->singleton(
    \Laravel\Fortify\Contracts\LoginResponse::class,
    \App\Actions\Fortify\LoginResponse::class
);
           // ✅ 登録後のリダイレクトを step2 に変更
        $this->app->singleton(
            RegisterResponseContract::class,
            CustomRegisterResponse::class
        );
    }
}
