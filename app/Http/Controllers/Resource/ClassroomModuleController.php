<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\ClassroomModule;
use App\Http\Requests\StoreClassroomModuleRequest;
use App\Http\Requests\UpdateClassroomModuleRequest;
use App\Models\Log;
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
        $auth = Auth::user();
        $role = $auth->role;
        $classroommodules = [];
        switch($role){
            case'admin':
                $classroommodules = ClassroomModule::all();
                break;
            case'instructor':
                $classroomids = $auth->classroom()->pluck('id');
                $classroommodules = ClassroomModule::with('classroom')
                    ->whereIn('classroom_id', $classroomids)
                    ->latest()
                    ->get();
                break;

            case'learner':
                $classroomids = $auth->enrolledUser()->pluck('classroom_id');
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
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomModuleRequest $request)
    {
        $auth = Auth::user();
        $validated = $request->validated();

        $classroommodule = ClassroomModule::create($validated);

        $enrolledLearners = $classroommodule->classroom->enrolledUser()
            ->whereHas('user', function($q) {
                $q->where('role', 'learner');
            })
            ->get();

        $lessons = $classroommodule->module->lesson;

        if ($lessons->isNotEmpty()) {
            foreach ($enrolledLearners as $enrolledUser) {
                foreach ($lessons as $lesson) {
                    // Create empty progress record
                    \App\Models\UserProgress::create([
                        'enrolled_user_id' => $enrolledUser->id,
                        'classroom_module_id' => $classroommodule->id,
                        'lesson_id' => $lesson->id,
                        'is_done' => 0,
                    ]);
                }
            }
        }

        $sysMsg = 'Successfully added module '.$classroommodule->module->name.' to classroom '.$classroommodule->classroom->name;

        Log::create([
            'user_id'=>$auth->id,
            'action'=>$sysMsg
        ]);

        return back()->with('success',$sysMsg);
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassroomModule $classroommodule)
    {
        $auth = Auth::user();
        $module = $classroommodule->module;

        return view($auth->role . '.module_view', [
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
        $auth = Auth::user();
        $this->authorize('delete', $classroommodule);
        $classroommodule->delete();

        $sysMsg = 'Successfully removed module'.$classroommodule->module->name.' from classroom'.$classroommodule->classroom->name;
        Log::create([
            'user_id'=>$auth->id,
            'action'=>$sysMsg
        ]);
        return back()->with('success',$sysMsg);
    }
}
