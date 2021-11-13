<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalCycle extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $guarded = [];

    // public function approvalStep() { // check this relation is used to delete it
    //     return $this->hasMany(ApprovalCycleApprovalStep::class);
    // }

    // Return all approval cycles approvalCycleApprovalStep (Joining table) records with its related records in approval_steps (table)
    public function approvalCycleApprovalStep()
    {
        return $this->hasMany(ApprovalCycleApprovalStep::class)->with('approvalStep');
    }
}
