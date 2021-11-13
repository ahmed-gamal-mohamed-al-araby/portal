<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function governorate()
    {
        return $this->belongsTo(Governorate::class);
    }

    public function getFullAddress()
    {
        $address = collect([
            "ar" => $this->country->name_ar . ', ' . $this->governorate->name_ar . ', ' . $this->city_ar . ', ' . $this->street_ar . ', ' . $this->building_no,
            "en" => $this->country->name_en . ', ' . $this->governorate->name_en . ', ' . $this->city_en . ', ' . $this->street_en . ', ' . $this->building_no,
        ]);
        return $address->toArray();
    }
}
