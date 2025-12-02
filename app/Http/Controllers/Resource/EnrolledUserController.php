<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\EnrolledUser;
use App\Http\Requests\StoreEnrolledUserRequest;
use App\Http\Requests\UpdateEnrolledUserRequest;
use App\Models\Classroom;
use App\Models\ClassroomModule;
use App\Models\Log as ModelsLog;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
        try {
            $validated = $request->validated();

            if (!isset($validated['user_id']) && isset($validated['email'])) {
                $email = $validated['email'];
                $userID = User::where('email', $email)->value('id');

                if (!$userID) {
                    return back()->withErrors(['email' => 'No user exists with that email.']);
                }

                $validated['user_id'] = $userID;
            }

            $exists = EnrolledUser::where('user_id', $validated['user_id'])
                ->where('classroom_id', $validated['classroom_id'])
                ->exists();

            if ($exists) {
                return back()->withErrors([
                    'duplicate' => 'This user is already enrolled in this classroom.'
                ]);
            }

            // Create enrollment
            $enrolleduser = EnrolledUser::create([
                'user_id' => $validated['user_id'],
                'classroom_id' => $validated['classroom_id'],
            ]);

            // Only generate progress for learners
            if ($enrolleduser->user->role === 'learner') {
                $this->generateProgress($enrolleduser->classroom, $enrolleduser->id);
            }

            $sysMsg = 'Successfully added ' . $enrolleduser->user->name . ' to ' . $enrolleduser->classroom->name;

            Log::create([
            'user_id' => Auth::user()->id,
            'action' => $sysMsg
            ]);

            return back()->with('success', $sysMsg);

        } catch (\Throwable $e) {

            Log::error('Enrollment process failed', [
                'error' => $e->getMessage(),
                'line'  => $e->getLine(),
                'file'  => $e->getFile(),
                'payload' => $request->all()
            ]);

            return back()->withErrors([
                'enroll' => 'Enrollment failed due to a server error.'
            ]);
        }
    }


    public function generateProgress(Classroom $classroom, $enrolled_user_id){
        $classroomModules = $classroom->classroomModule;
        foreach ($classroomModules as $classroomModule) {
            Log::info('Lesson Pointer', [$classroomModule->lesson]);
            foreach ($classroomModule->module->lesson as $lesson) {
                UserProgress::create([
                    'enrolled_user_id' => $enrolled_user_id,
                    'classroom_module_id' => $classroomModule->id,
                    'lesson_id' => $lesson->id,
                    'is_done' => 0,
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EnrolledUser $enrolleduser)
    {
        $auth = Auth::user();
        $user = $enrolleduser->user;
        $classroom = $enrolleduser->classroom;
        $progress = $enrolleduser->userProgress;

        return view($auth->role.'.user_view', compact('user', 'progress', 'classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EnrolledUser $enrolleduser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEnrolledUserRequest $request, EnrolledUser $enrolleduser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(EnrolledUser $enrolleduser)
    {
        $enrolleduser->classroom;

        $this->authorize('delete', $enrolleduser);

        $enrolleduser->delete();

        $sysMsg = 'Successfully removed '.$enrolleduser->user->name.' from '.$enrolleduser->classroom->name;

        Log::create([
            'user_id'=>Auth::user()->id,
            'action'=> $sysMsg
        ]);

        return back()->with('success',$sysMsg);
    }
}
