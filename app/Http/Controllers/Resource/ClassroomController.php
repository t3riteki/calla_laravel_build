<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
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
        $user = Auth::user();

        $role = $user->role;
        $classrooms = [];
        switch($role){
            case'admin':
                $classrooms = Classroom::all();
                break;
            case'instructor':
                // Get ALL classrooms owned by this instructor
                $classrooms = Classroom::with('User')
                    ->where('owner_id', $user->id)
                    ->withCount([
                        'EnrolledUser as enrollee_count' => function ($query) {
                            $query->where('role', 'learner');
                        }])
                    ->latest()
                    ->get();
            break;

            case 'learner':
                $classrooms = [
                    'JoinedClasses' => Classroom::whereHas('enrolledUser', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
                    })->get(),

                    'JoinableClasses' => Classroom::whereDoesntHave('enrolledUser', function ($q) use ($user) {
                        $q->where('user_id', $user->id);
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
        $user = Auth::User();
        $this->authorize('create', Classroom::class);
        $validated = $request->validated();
        $validated['owner_id'] = $user->id;
        $classroom = $user->Classroom()->create($validated);

        $classroom->EnrolledUser()->create([
            'user_id' => $user->id,
        ]);

        return back()->with('success','Successfully created '.$classroom->name);
    }

    public function join(Classroom $classroom, Request $request)
    {
        $code = $request->code;

        if ($classroom->code !== $code) {
            return back()->with('error', 'Invalid Code');
        }

        $user = Auth::user();

        if ($user->classroom()->where('classroom_id', $classroom->id)->exists()) {
            return back()->with('error', 'You are already enrolled in this classroom.');
        }

        $user->enrolledUser()->create([
            'classroom_id' => $classroom->id,
        ]);

        return back()->with('success', 'Successfully joined ' . $classroom->name);
    }


    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        $user = Auth::user();
        $this->authorize('view',$classroom);
        return view($user->role.'.classroom_view',compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $user = Auth::user();
        $this->authorize('update',$classroom);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $user = Auth::user();
        $this->authorize('update',$classroom);
        $validated= $request->validated();
        $classroom->update($validated);

        return back()->with('success','Successfully updated '.$classroom->name);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $user = Auth::user();
        $this->authorize('delete',$classroom);
        $classroom->delete();

        return back()->with('success','Successfully deleted '.$classroom->name);
    }
}
