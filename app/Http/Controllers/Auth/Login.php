<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Login extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'=>'required|email',
                'password'=>'required'
            ]
        );
        // Attempt Log in
        if(Auth::attempt($credentials,$request->boolean('remember'))){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard')->with('success','Welcome Back!');
        }

        return back()
            ->withErrors(['email' => 'Email does not exist :<'])
            ->onlyInput('email');
    }
}
