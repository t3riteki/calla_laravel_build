<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Requests\UpdateClassroomRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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
        return view($role.'.classrooms');
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
        $this->authorize('create',$user);
        $validated = $request->validated();
        $classroom = $user->Classroom()->create($validated);

        $classroom->EnrolledUser()->create([
            'user_id' => $user->id,
        ]);

        return redirect($user->role.'.dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        $user = Auth::user();
        return view($user->role.'.viewClassroom',compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $user = Auth::user();
        $this->authorize('update',$user);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassroomRequest $request, Classroom $classroom)
    {
        $user = Auth::user();
        $this->authorize('update',$user);
        $validated= $request->validated();
        $classroom->update($validated);

        return redirect($user->role.'.dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $user = Auth::user();
        $this->authorize('delete',$user);
        $classroom->delete();
        return redirect($user->role.'.dashboard');
    }
}
