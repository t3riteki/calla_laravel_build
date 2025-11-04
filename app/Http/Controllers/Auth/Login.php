<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(LoginRequest $request)
    {
        $request->authenticate();
        $user = $request->user();
        $request->session()->regenerate();
        return redirect()->intended('/dashboard')->with('success','Welcome '.$user->role.', '.$user->name);
    }
}
