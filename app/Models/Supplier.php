<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use HasFactory, SoftDeletes;
    public $guarded = [];
    public $timestamps = false;

    public function familyNames()
    {
        return $this->belongsToMany(FamilyName::class, 'family_name_suppliers');
    }

    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function supplierBankTransfer()
    {
        return $this->hasOne(SupplierBankTransfer::class);
    }

    public function supplierCheque(){
        return $this->hasOne(SupplierCheque::class);
    }

    public function personSuppliers()
    {
        return $this->hasMany(PersonSupplier::class);
    }


}
