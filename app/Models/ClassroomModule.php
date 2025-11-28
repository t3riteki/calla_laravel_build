<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClassroomModule extends Model
{
    /** @use HasFactory<\Database\Factories\ClassroomModuleFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'module_id',
        'classroom_id',
        'added_by'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

        ];
    }

    public function classroom():BelongsTo{
        return $this->belongsTo(Classroom::class);
    }
    public function enrolledUser():BelongsTo{
        return $this->belongsTo(EnrolledUser::class,'added_by');
    }
    public function module():BelongsTo{
        return $this->belongsTo(Module::class);
    }
    public function userProgress():HasMany{
        return $this->hasMany(UserProgress::class);
    }

    public function isCompleted($enrolledUserId)
    {
        $totalLessons = $this->lessons()->count();

        $completedLessons = UserProgress::where('enrolled_user_id', $enrolledUserId)
            ->where('classroom_module_id', $this->id)
            ->where('is_done', true)
            ->count();

        return $totalLessons > 0 && $completedLessons === $totalLessons;
    }
}
