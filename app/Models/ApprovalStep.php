<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalStep extends Model
{
    use HasFactory;

    public $guarded = [];

    // Return approvalCycleApprovalStep (Joining table) record with its related record in approval_cycles (table)
    public function approvalCycleApprovalStep()
    {
        return $this->hasMany(ApprovalCycleApprovalStep::class)->with('approvalCycle');
    }
}
