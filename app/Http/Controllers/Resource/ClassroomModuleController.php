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
        $user = Auth::user();
        $role = $user->role;
        $classroommodules = [];
        switch($role){
            case'admin':
                $classroommodules = ClassroomModule::all();
                break;
            case'instructor':
                $classroomids = $user->classroom()->pluck('id');
                $classroommodules = ClassroomModule::with('classroom')
                    ->whereIn('classroom_id', $classroomids)
                    ->latest()
                    ->get();
                break;

            case'learner':
                $classroomids = $user->enrolledUser()->pluck('classroom_id');
                $classroommodules = ClassroomModule::with('classroom')
                    ->whereIn('classroom_id', $classroomids)
                    ->withCount([
                        'enrolledUser as enrollee_count' => function ($query) {
                            $query->where('role', 'learner');
                        }
                    ])
                    ->latest()
                    ->get();
                break;
        }

        return view($role . '.modules', [
            'classroommodules' => $classroommodules
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
    public function store(StoreClassroomModuleRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $classroomModule = ClassroomModule::create($validated);

        return back()->with('success', 'Successfully added '.$classroomModule->module->name.' to '.$classroomModule->classroom->name);
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
        $message = 'Successfully removed '.$classroommodule->module->name.' from '.$classroommodule->classroom->name;
        $classroommodule->delete();

        return back()->with('success', $message);
    }
}
