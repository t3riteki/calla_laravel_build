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

    public function User():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function Classroom():BelongsTo{
        return $this->belongsTo(Classroom::class);
    }
    public function UserProgress():HasMany{
        return $this->hasMany(UserProgress::class);
    }
    public function ClassroomModule():HasMany{
        return $this->hasMany(ClassroomModule::class);
    }
}
