<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobName extends Model
{
    use HasFactory, SoftDeletes;
    public $guarded = [];
    public $timestamps = false;

    public function jobCode()
    {
        return $this->belongsTo(JobCode::class);
    }

    public function department()
    {
        return $this->jobCode()->belongsTo(Department::class);
    }
}
