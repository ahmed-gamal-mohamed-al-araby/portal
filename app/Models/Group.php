<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use HasFactory, SoftDeletes;
    public $guarded = [];
    public $timestamps = false;

    public function subGroups() {
        return $this->hasMany(SubGroup::class);
    }
}
