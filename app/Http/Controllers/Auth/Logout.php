<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Logout extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = $request->user();
        Auth::logout();
        Log::create([
            'user_id' => $user->id,
            'action' => 'Logged out'
        ]);
        return redirect('/')->with('success', 'Successfully logged out');
    }
}
