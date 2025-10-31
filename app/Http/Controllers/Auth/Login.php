<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }
}
