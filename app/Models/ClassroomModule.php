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

    public function Classroom():BelongsTo{
        return $this->belongsTo(Classroom::class);
    }
    public function EnrolledUser():BelongsTo{
        return $this->belongsTo(EnrolledUser::class);
    }
    public function Module():BelongsTo{
        return $this->belongsTo(Module::class);
    }
    public function UserProgress():HasMany{
        return $this->hasMany(UserProgress::class);
    }
}
