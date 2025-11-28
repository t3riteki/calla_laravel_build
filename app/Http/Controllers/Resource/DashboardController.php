<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Module;
use App\Models\ClassroomModule;
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

    private function adminData(){
        return [];
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
