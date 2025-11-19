<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EnrolledUser extends Model
{
    /** @use HasFactory<\Database\Factories\EnrolledUserFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id','classroom_id',
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

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function classroom():BelongsTo{
        return $this->belongsTo(Classroom::class, 'classroom_id');
    }
    public function userProgress():HasMany{
        return $this->hasMany(UserProgress::class);
    }
    public function classroomModule():HasMany{
        return $this->hasMany(ClassroomModule::class);
    }
}
