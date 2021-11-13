<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonSupplier extends Model
{
    use HasFactory;
    public $guarded = [];
    public $timestamps = false;

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
