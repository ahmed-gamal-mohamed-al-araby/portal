<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    public function manager()
    {
        return $this->belongsTo(User::class);
    }

    public function delegated()
    {
        return $this->belongsTo(User::class);
    }

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }

    public function jobCodes()
    {
        return $this->hasMany(JobCode::class);
    }
}
