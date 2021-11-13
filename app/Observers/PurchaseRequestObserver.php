<?php

namespace App\Observers;

use App\Traits\ApprovalCycleTrait;
use App\Models\ApprovalCycle;
use App\Models\ApprovalTimeline;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\Log;

class PurchaseRequestObserver
{
    use ApprovalCycleTrait;

    /**
     * Handle the PurchaseRequest "created" event.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return void
     */
    public function created(PurchaseRequest $purchaseRequest)
    {
        $purchaseRequest->update([
            'sent' => '1'
        ]);
        
        $creatorUser = $purchaseRequest->requester;
        $purchaseRequestGroup = $purchaseRequest->group;

        $approvalCycleApprovalStep = ApprovalCycle::where('code', $purchaseRequestGroup->code)->first()->approvalCycleApprovalStep()->where('previous_id', NULL)->first();

        $stepValue =  json_decode($approvalCycleApprovalStep->approvalStep->value);
        $approvalUser = '';
        if (count($stepValue->depth)) {
            $approvalUser = $creatorUser;
            foreach ($stepValue->depth as $step) {
                $approvalUser = $approvalUser->{$step};
            }
        } else {
            $approvalUser = $this->getComplexNextUserForApprovals($stepValue->query->T, $stepValue->query->CONs,  $stepValue->query->depth);
        }
        
        // This cycle depend on group
        $purchaseRequest->group;
        // Set first approval cycle timeline
        ApprovalTimeline::create([
            'table_name' => 'purchase_requests',
            'record_id' => $purchaseRequest->id,
            'approval_cycle_approval_step_id' => $approvalCycleApprovalStep->id,
            'user_id' => $approvalUser->id,
        ]);
    }

    /**
     * Handle the PurchaseRequest "updated" event.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return void
     */
    public function updated(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Handle the PurchaseRequest "deleted" event.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return void
     */
    public function deleted(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Handle the PurchaseRequest "restored" event.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return void
     */
    public function restored(PurchaseRequest $purchaseRequest)
    {
        //
    }

    /**
     * Handle the PurchaseRequest "force deleted" event.
     *
     * @param  \App\Models\PurchaseRequest  $purchaseRequest
     * @return void
     */
    public function forceDeleted(PurchaseRequest $purchaseRequest)
    {
        //
    }
}
