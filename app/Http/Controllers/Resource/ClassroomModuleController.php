<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\ClassroomModule;
use App\Http\Requests\StoreClassroomModuleRequest;
use App\Http\Requests\UpdateClassroomModuleRequest;

use Illuminate\Support\Facades\Auth;

class ClassroomModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        return view($role.'.classroommodules');
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
    public function store(StoreClassroomModuleRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassroomModule $classroomModule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassroomModule $classroomModule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomModuleRequest $request, ClassroomModule $classroomModule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassroomModule $classroomModule)
    {
        //
    }
}
