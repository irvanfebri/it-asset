<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Classroom extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * Get all of the comments for the Classroom
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function homerooms(): HasMany
    {
        return $this->hasMany(HomeRoom::class, 'teachers_id', 'id');
    }
}
