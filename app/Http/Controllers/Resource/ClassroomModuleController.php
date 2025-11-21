<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\ClassroomModule;
use App\Http\Requests\StoreClassroomModuleRequest;
use App\Http\Requests\UpdateClassroomModuleRequest;
use App\Models\Module;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class ClassroomModuleController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(ClassroomModule $classroommodule)
    {
        $user = Auth::user();
        $module = $classroommodule->module;

        return view($user->role . '.module_view', [
            'module' => $module,
            'classroomModule' => $classroommodule
        ]);
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
    public function update(UpdateClassroomModuleRequest $request, ClassroomModule $classroommodule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassroomModule $classroommodule)
    {

        $this->authorize('delete', $classroommodule);

        $classroommodule->delete();

        return back()->with('success', 'Module removed successfully');
    }
}
