<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProgress extends Model
{
    /** @use HasFactory<\Database\Factories\UserProgressFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'enrolled_user_id','classroom_module_id','lesson_id','is_done',
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
            'is_done' => 'boolean'
        ];
    }

    public function EnrolledUser():BelongsTo{
        return $this->belongsTo(EnrolledUser::class,);
    }
    public function ClassroomModule():BelongsTo{
        return $this->belongsTo(ClassroomModule::class);
    }
    public function Lesson():BelongsTo{
        return $this->belongsTo(Lesson::class);
    }
}
