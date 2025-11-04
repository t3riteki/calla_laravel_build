<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\UserProgress;
use App\Http\Requests\StoreUserProgressRequest;
use App\Http\Requests\UpdateUserProgressRequest;

use Illuminate\Support\Facades\Auth;

class UserProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        return view($role.'.userprogresses');
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
    public function store(StoreUserProgressRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserProgress $userProgress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserProgress $userProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProgressRequest $request, UserProgress $userProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserProgress $userProgress)
    {
        //
    }
}
