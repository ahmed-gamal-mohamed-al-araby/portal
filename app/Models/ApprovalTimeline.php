<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApprovalTimeline extends Model
{
    use HasFactory;

    public $guarded = [];

    // Return users (table) record that take approvalTimeline action
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Return approvalCycleApprovalStep (Joining table) record with its related record in approval_cycles (table) and related record in approval_steps (table)
    public function approvalCycleApprovalStep()
    {
        return $this->belongsTo(ApprovalCycleApprovalStep::class)->with('approvalCycle')->with('approvalStep');
    }

    public function comment()
    {
        return $this->hasOne(ApprovalTimelineComment::class);
    }
}
