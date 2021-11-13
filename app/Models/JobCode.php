<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCode extends Model
{
    use HasFactory, SoftDeletes;
    public $guarded = [];
    public $timestamps = false;

    public function jobGrades()
    {
        return $this->hasMany(JobGrade::class);
    }

    public function jobNames()
    {
        return $this->hasMany(JobName::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
