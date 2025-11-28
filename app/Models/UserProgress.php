<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProgress extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrolled_user_id','classroom_module_id','lesson_id','is_done',
    ];

    protected function casts(): array
    {
        return [
            'is_done' => 'boolean'
        ];
    }

    /* ----------------------- RELATIONSHIPS ----------------------- */

    public function EnrolledUser(): BelongsTo
    {
        return $this->belongsTo(EnrolledUser::class);
    }

    public function ClassroomModule(): BelongsTo
    {
        return $this->belongsTo(ClassroomModule::class);
    }

    public function Lesson(): BelongsTo
    {
        return $this->belongsTo(Lesson::class);
    }


    /* ----------------------- HELPERS ----------------------- */

    // Returns ALL progress entries for the user
    public static function getUserProgress($enrolledUserId)
    {
        return self::where('enrolled_user_id', $enrolledUserId)
            ->with(['ClassroomModule', 'Lesson'])
            ->get();
    }


    /* ----------------------- NEW FUNCTIONS ----------------------- */

    /**
     * Return all COMPLETED lessons for the user.
     */
    public static function getCompletedLessons($enrolledUserId)
    {
        return self::where('enrolled_user_id', $enrolledUserId)
            ->where('is_done', true)
            ->with('Lesson')
            ->get();
    }

    /**
     * Return all COMPLETED classroom modules for the user.
     * A module is completed when ALL its lessons are completed.
     */
    public static function getCompletedModules($enrolledUserId)
    {
        // Get all modules the user has progress in
        $modules = ClassroomModule::with('lessons')->get();

        // Filter only completed modules
        return $modules->filter(function ($module) use ($enrolledUserId) {
            $totalLessons = $module->lessons->count();

            $completedLessons = self::where('enrolled_user_id', $enrolledUserId)
                ->where('classroom_module_id', $module->id)
                ->where('is_done', true)
                ->count();

            return $totalLessons > 0 && $completedLessons === $totalLessons;
        })->values(); // clean JSON indexing
    }

    /**
     * Return completed modules WITH completed lesson details.
     */
    public static function getCompletedModulesWithLessons($enrolledUserId)
    {
        $completedModules = self::getCompletedModules($enrolledUserId);

        return $completedModules->map(function ($module) use ($enrolledUserId) {
            $module->completed_lessons = self::where('enrolled_user_id', $enrolledUserId)
                ->where('classroom_module_id', $module->id)
                ->where('is_done', true)
                ->with('Lesson')
                ->get();

            return $module;
        });
    }
}
