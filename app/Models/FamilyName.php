<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyName extends Model
{
    use HasFactory, SoftDeletes;
    public $guarded = [];
    public $timestamps = false;

    public function subGroup()
    {
        return $this->belongsTo(SubGroup::class);
    }

    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class , 'family_name_suppliers');
    }

}
