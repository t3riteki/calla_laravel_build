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

        // Get ALL classrooms owned by this instructor
        $classrooms = Classroom::with('User')
            ->where('owner_id', $user->id)
            ->withCount([
                'EnrolledUser as enrollee_count' => function ($query) {
                    $query->where('role', 'learner');
                }
            ])
            ->latest()
            ->get();

        return view($user->role . '.classrooms', [
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

        return redirect()->back();
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

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        $user = Auth::user();
        $this->authorize('delete',$classroom);
        $classroom->delete();
        return redirect()->back();
    }
}
