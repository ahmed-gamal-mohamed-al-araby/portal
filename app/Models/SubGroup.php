<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubGroup extends Model
{
    use HasFactory, SoftDeletes;
    public $guarded = [];
    public $timestamps = false;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    public function familyNames() {
        return $this->hasMany(FamilyName::class);
    }
}
