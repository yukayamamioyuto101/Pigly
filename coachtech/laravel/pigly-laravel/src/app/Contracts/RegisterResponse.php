<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface RegisterResponse
{
    /**
     * Handle the response after user registration.
     */
    public function toResponse($request);
}
