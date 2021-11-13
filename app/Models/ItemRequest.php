<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemRequest extends Model
{
    use HasFactory;
    public $guarded = [];
    public $timestamps = false;

    public function purchaseRequest()
    {
        return $this->belongsTo(PurchaseRequest::class);
    }

    public function familyName()
    {
        return $this->belongsTo(familyName::class);
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
