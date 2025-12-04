<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\EnrolledUser;
use App\Http\Requests\StoreEnrolledUserRequest;
use App\Http\Requests\UpdateEnrolledUserRequest;
use App\Models\Classroom;
use App\Models\Log as ModelsLog; // kept alias
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Facade

class EnrolledUserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $user = Auth::user();
        $role = $user->role;
        return view($role.'.enrolledusers');
    }

    public function store(StoreEnrolledUserRequest $request)
    {
        try {
            $validated = $request->validated();

            // Auto-resolve email to ID if needed
            if (!isset($validated['user_id']) && isset($validated['email'])) {
                $user = User::where('email', $validated['email'])->first();
                if (!$user) {
                    return back()->withErrors(['email' => 'No user exists with that email.']);
                }
                $validated['user_id'] = $user->id;
            }

            // Check for duplicate enrollment
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

            // FIX 1: Use the aliased Model (ModelsLog), not the Facade (Log)
            ModelsLog::create([
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
            // Check if module has lessons before looping
            if($classroomModule->module->lesson->isEmpty()) continue;

            foreach ($classroomModule->module->lesson as $lesson) {
                UserProgress::create([
                    'enrolled_user_id' => $enrolled_user_id,
                    'classroom_module_id' => $classroomModule->id,
                    'lesson_id' => $lesson->id,
                    'is_completed' => 0, // FIX 2: Changed 'is_done' to 'is_completed' to match Dashboard
                ]);
            }
        }
    }

    // ... destroy, show, and other methods remain the same ...

    public function destroy(EnrolledUser $enrolleduser)
    {
        $this->authorize('delete', $enrolleduser);

        $name = $enrolleduser->user->name;
        $className = $enrolleduser->classroom->name;

        $enrolleduser->delete();

        $sysMsg = 'Successfully removed '.$name.' from '.$className;

        // FIX: Use ModelsLog here too
        ModelsLog::create([
            'user_id'=>Auth::user()->id,
            'action'=> $sysMsg
        ]);

        return back()->with('success',$sysMsg);
    }
}
