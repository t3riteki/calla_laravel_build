<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Log;

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

        Log::create([
            'user_id' => $user->id,
            'action' => 'Logged in'
        ]);
        return redirect()->intended('/dashboard')->with('success','Welcome '.$user->role.', '.$user->name);
    }
}
