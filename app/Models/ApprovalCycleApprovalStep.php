<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalCycleApprovalStep extends Model
{
    use HasFactory;

    public $guarded = [];

    // Return approval_cycle (table) record
    public function approvalCycle()
    {
        return $this->belongsTo(ApprovalCycle::class);
    }

    // Return approval_step (table) record
    public function approvalStep()
    {
        return $this->belongsTo(approvalStep::class);
    }

    // Return all approval_timelines (table) records related to approval_cycle_approval_steps (table) record
    public function approvalTimeLine()
    {
        return $this->hasMany(ApprovalTimeline::class);
    }

    // Return the next approval_cycle_approval_steps (table) record
    public function next()
    {
        return $this->belongsTo(ApprovalCycleApprovalStep::class);
    }

    // Return the previous approval_cycle_approval_steps (table) record
    public function previous()
    {
        return $this->belongsTo(ApprovalCycleApprovalStep::class);
    }
}
