<?php

namespace App\Http\Controllers\Resource;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        // Note: Ensure your UserPolicy 'viewAny' allows instructors/learners
        // if you want them to access this page, otherwise remove this line.
        // $this->authorize('viewAny', User::class);

        $role = $user->role;
        $users = [];

        switch ($role) {
            case 'admin':
                // Admin sees ALL users in the database
                $users = User::latest()->get();
                break;

            case 'instructor':
                // Instructor sees a directory of Learners (to invite/view)
                $users = User::where('role', 'learner')
                    ->latest()
                    ->get();

                // OR: If they should only see their own enrolled students:
                // $users = User::whereHas('enrolledUser.classroom', function($q) use ($user){
                //      $q->where('owner_id', $user->id);
                // })->get();
                break;

            case 'learner':
                // Learner sees a directory of Instructors (to find mentors)
                $users = User::where('role', 'instructor')
                    ->latest()
                    ->get();
                break;
        }

        return view($role . '.users', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->authorize('view',$user);
        return view($user->role.'.user_view',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {

    }
}
