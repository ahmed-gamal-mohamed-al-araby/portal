<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sector extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];

    function head()
    {
        return $this->belongsTo(User::class);
    }

    public function delegated()
    {
        return $this->belongsTo(User::class);
    }

    function departments()
    {
        return $this->hasMany(Department::class);
    }

    function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function sectors()
    {
        return $this->hasMany(Sector::class, 'parent_id');
    }
}
