<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Module;
use App\Models\ClassroomModule;
use App\Models\User;
use App\Models\UserProgress;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // View
    public function index(){
        $user = Auth::user();
        $role = $user->role;
        switch($role){
            case 'admin':
                $data = $this->adminData();
                break;
            case 'instructor':
                $data = $this->instructorData($user);
                break;
            case 'learner':
                $data = $this->learnerData($user);
                break;

            default:
                abort(403,'Unauthorized');
        }

        return view($role. '.dashboard', ['data' => $data]);
    }

    private function adminData()
    {
        // 1. Get Counts for the "Quick Metrics" and "Stat Cards"
        $classroom_count = Classroom::count();
        $module_count = Module::count();
        $learner_count = User::where('role', 'learner')->count();
        $instructor_count = User::where('role', 'instructor')->count();

        // 2. Get Recent Users for "User Overview" table
        // We take the latest 5 to fit the table UI
        $users = User::latest()
            ->take(5)
            ->get();

        // 3. Get Recent Classrooms for "Classroom Overview" table
        // We eager load 'EnrolledUser.user' because your blade view performs a
        // filter on the collection: $classroom->EnrolledUser->where('user.role', 'learner')
        $classrooms = Classroom::with('EnrolledUser.user')
            ->latest()
            ->take(5)
            ->get();

        // 4. Get Recent Modules for "Module Overview" table
        // We eager load 'ClassroomModule' so the view can count instances
        $modules = Module::with('ClassroomModule')
            ->latest()
            ->take(5)
            ->get();

        // 5. Compile into the $data array expected by the view
        $data = [
            'classroom_count'  => $classroom_count,
            'module_count'     => $module_count,
            'learner_count'    => $learner_count,
            'instructor_count' => $instructor_count,
            'users'            => $users,
            'classrooms'       => $classrooms,
            'modules'          => $modules,
        ];

        return $data;
    }

    private function instructorData($user){
        $modules = Module::with('User')
        ->where('owner_id',auth()->id())
        ->withCount('ClassroomModule')
        ->latest()
        ->take(5)
        ->get();

        $module_count = Module::with('User')
        ->where('owner_id',auth()->id())
        ->count();

        $classrooms = Classroom::with('User')
        ->where('owner_id', auth()->id())
        ->withCount([
            'EnrolledUser as enrollee_count'=>function($query){
                $query->where('role','learner');
            }
        ])
        ->latest()
        ->take(5)
        ->get();

        $classroom_count = Classroom::with('User')
        ->where('owner_id', auth()->id())
        ->count();

        $data = ['modules'=>$modules,'module_count'=>$module_count, 'classrooms'=>$classrooms,'classroom_count'=>$classroom_count];
        return $data;
    }

    private function learnerData($user)
    {
        // Get classrooms the user joined
        $enrolledClassrooms = $user->enrolledUser()
            ->with('classroom')
            ->take(5)
            ->get()
            ->pluck('classroom');

        // Get modules from those classrooms
        $classroomModules = ClassroomModule::whereIn(
                'classroom_id',
                $enrolledClassrooms->pluck('id')
            )
            ->with(['module.lesson', 'classroom'])
            ->latest()
            ->take(5)
            ->get();

        // Compute completed modules
        $completedModules = $classroomModules->filter(function ($classroomModule) use ($user) {

            $module = $classroomModule->module;

            $totalLessons = $module->lesson->count();

            if ($totalLessons === 0) {
                return false;
            }

            // Count user progress for this module
            $completedLessons = UserProgress::where('user_id', $user->id)
                ->where('module_id', $module->id)
                ->where('is_completed', true)
                ->count();

            return $completedLessons >= $totalLessons;
        });

        $data = [
            'joinedClassrooms' => $enrolledClassrooms,
            'classroommodules' => $classroomModules,
            'completedModules' => $completedModules,
            'completedCount' => $completedModules->count(),
        ];

        return $data;
    }

}
