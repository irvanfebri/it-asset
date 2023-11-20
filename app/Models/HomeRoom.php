<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class HomeRoom extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get the teacher that owns the HomeRoom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class, 'teachers_id', 'id');
    }

    /**
     * Get the user  classroomowns the HsomeRoom
     *
     * @return \Illuminate\DatabaClassroomloquent\Relations\BelongsTo
     */
    public function classroom(): BelongsTo
    {
        return $this->belongsTo(Classroom::class, 'classrooms_id', 'id');
    }

    /**
     * Get the periode that owns the HomeRoom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function periode(): BelongsTo
    {
        return $this->belongsTo(Periode::class, 'periode_id', 'id');
    }
}
