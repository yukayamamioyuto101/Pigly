<?php

namespace App\Actions\Fortify;

use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class CustomRegisterResponse implements RegisterResponseContract
{
    /**
     * Handle the response after a successful registration.
     */
    public function toResponse($request)
    {
        // STEP2 にリダイレクト
        return redirect()->route('register.step2');
    }
}
