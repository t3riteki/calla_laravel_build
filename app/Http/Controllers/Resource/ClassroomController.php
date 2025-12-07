<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use App\Models\Log;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ClassroomController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auth = Auth::user();

        $role = $auth->role;
        $classrooms = [];
        switch($role){
            case'admin':
                $classrooms = Classroom::all();
                break;
            case'instructor':

                $classrooms = Classroom::with('User')
                    ->where('owner_id', $auth->id)
                    ->withCount([
                        'EnrolledUser as enrollee_count' => function ($query) {
                            $query->where('role', 'learner');
                        }])
                    ->latest()
                    ->get();
            break;

            case 'learner':
                $classrooms = [
                    'JoinedClasses' => Classroom::whereHas('enrolledUser', function ($q) use ($auth) {
                        $q->where('user_id', $auth->id);
                    })->get(),

                    'JoinableClasses' => Classroom::whereDoesntHave('enrolledUser', function ($q) use ($auth) {
                        $q->where('user_id', $auth->id);
                    })->get(),
                ];
            break;
        }

        return view($role . '.classrooms', [
            'classrooms' => $classrooms
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassroomRequest $request)
    {
        $auth = Auth::User();
        $this->authorize('create', Classroom::class);
        $validated = $request->validated();
        $validated['owner_id'] = $auth->id;
        $classroom = $auth->Classroom()->create($validated);

        $classroom->EnrolledUser()->create([
            'user_id' => $auth->id,
        ]);

        $sysMsg = 'Successfully created classroom '.$classroom->name;
        Log::create([
            'user_id'=>$auth->id,
            'action'=>$sysMsg
        ]);
        return back()->with('success',$sysMsg);
    }

    public function join(Classroom $classroom, Request $request)
    {
        $code = $request->code;

        if ($classroom->code !== $code) {
            return back()->with('error', 'Invalid Code');
        }

        $auth = Auth::user();

        if ($auth->classroom()->where('classroom_id', $classroom->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this classroom.');
        }

        $auth->enrolledUser()->create([
            'classroom_id' => $classroom->id,
        ]);

        $sysMsg = 'Successfully joined classroom '.$classroom->name;
        Log::create([
            'user_id'=>$auth->id,
            'action'=>$sysMsg
        ]);
        return back()->with('success',$sysMsg);
    }


    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        $auth = Auth::user();
        $this->authorize('view',$classroom);
        return view($auth->role.'.classroom_view',compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $auth = Auth::user();
        $this->authorize('update',$classroom);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $auth = Auth::user();
        $this->authorize('update',$classroom);
        $validated= $request->validated();
        $classroom->update($validated);

        $sysMsg = 'Successfully updated classroom '.$classroom->name;
        Log::create([
            'user_id'=>$auth->id,
            'action'=>$sysMsg
        ]);
        return back()->with('success',$sysMsg);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $auth = Auth::user();
        $this->authorize('delete',$classroom);
        $classroom->delete();

        $sysMsg = 'Successfully deleted classroom '.$classroom->name;
        Log::create([
            'user_id'=>$auth->id,
            'action'=>$sysMsg
        ]);
        return back()->with('success',$sysMsg);
    }
}
