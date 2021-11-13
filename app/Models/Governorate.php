<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Governorate extends Model
{
    use HasFactory, SoftDeletes;

    public $guarded = [];
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
