<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\EnrolledUser;
use App\Http\Requests\StoreEnrolledUserRequest;
use App\Http\Requests\UpdateEnrolledUserRequest;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class EnrolledUserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        return view($role.'.enrolledusers');
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
    public function store(StoreEnrolledUserRequest $request)
    {
        $user = Auth::User();
        $this->authorize('create',$user);
        $validated = $request->validated();

        $enrollment = $user->EnrolledUser()->create($validated);

        return redirect($user->role.'.dashboard');

    }

    /**
     * Display the specified resource.
     */
    public function show(EnrolledUser $enrolledUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EnrolledUser $enrolledUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrolledUserRequest $request, EnrolledUser $enrolledUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EnrolledUser $enrolledUser)
    {
        $user = Auth::user();
        $this->authorize('delete',$user);
        $enrolledUser->delete();
        return redirect($user->role.'.dashboard');
    }
}
