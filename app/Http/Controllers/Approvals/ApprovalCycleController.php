<?php

namespace App\Http\Controllers\Approvals;

use App\Http\Controllers\Controller;
use App\Traits\ApprovalCycleTrait;
use App\Traits\ToastrTrait;
use App\Models\ApprovalCycle;
use App\Models\ApprovalTimeline;
use App\Models\ItemRequest;
use App\Models\User;
use App\Models\Project;
use App\Models\Site;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ApprovalCycleController extends Controller
{

    use ApprovalCycleTrait, ToastrTrait;

     // Show all Approval cycles
     public function showAllCycles()
     {
        $approvalCycles = ApprovalCycle::all();
 
         return view('dashboard-views.approval.all', compact('approvalCycles'));
     }

    // Show all pending cycle for currnt authenticated user
    public function index()
    {
        $ApprovalTimelines = $this->getCurrentUserPendingApprovals();

        return view('dashboard-views.approval.index', compact('ApprovalTimelines'));
    }

    // Show approval cycle steps name
    public function show($id)

    {
        $approvalCycle = ApprovalCycle::where('id', $id)->firstOrFail();
        $approvalCycleSteps = $this->getApprovalCycleSteps($id);

        $approvalCycle = [
            'name_ar' => $approvalCycle->name_ar,
            'name_en' => $approvalCycle->name_en,
            'steps' => $approvalCycleSteps,
        ];

        // dd($approvalCycle);

        return view('dashboard-views.approval.show', compact('approvalCycle'));
    }

      // Show approval cycle steps name
      public function showOrder($id)
    
      {
        // return $id;
        
         $order= ApprovalTimeline::where('id', $id)->firstOrFail();
           $purchaseOrder= PurchaseRequest::where('id', $order->record_id)->firstOrFail();
         //  return $purchaseOrder;
        //  x=[]
          $itemsorders= ItemRequest::where('purchase_request_id', $purchaseOrder->id)->get();
          $ApprovalTimeline = $this->getCurrentUserPendingApprovals();
         return view('dashboard-views.approval.show_order', compact('order','purchaseOrder','itemsorders','ApprovalTimeline'));
      }

    // show timeline for specific table record approval cycle
    public function timeline($tableName, $recordId)
    {
        $timelines = $this->getApprovalCycleTimelines($tableName, $recordId);
        $cycleName = ApprovalTimeline::where('table_name', $tableName)->where('record_id', $recordId)->firstOrFail()->approvalCycleApprovalStep->approvalCycle;
        $codeOrId = $recordId;
        return view('dashboard-views.approval.timeline', compact('timelines', 'cycleName', 'codeOrId'));
    }

    // show timeline for specific table record approval cycle By id
    public function timelineById(ApprovalTimeline $approvalTimeline )
    {
        $cycleName = $approvalTimeline->approvalCycleApprovalStep->approvalCycle;
        $timelines = $this->getApprovalCycleTimelines($approvalTimeline->table_name, $approvalTimeline->record_id);
        $codeOrId = $approvalTimeline->record_id;
        $PurchaseRequest = PurchaseRequest::where("id",$approvalTimeline->record_id)->first();
        $user = User::find($PurchaseRequest->requester_id);
        $created_at = $approvalTimeline->created_at;
        return view('dashboard-views.approval.timeline', compact('timelines', 'cycleName', 'codeOrId' , 'user' , 'created_at'));
    }

    // Validate that this user is user in timeline -------------------------------------------------------------------------------------

    // Take approve action
    public function approve($id)
    {
        $approvalTimeline = ApprovalTimeline::where('id', $id)->firstOrFail();
        $model = $this->getModelFromClassName($approvalTimeline->table_name);
        $creatorUser = $model::findOrFail($approvalTimeline->record_id)->requester;

        DB::beginTransaction();
        try {
            $approvalTimeline->update([
                'approval_status' => 'A'
            ]);

            $currentApprovalCycleApprovalStep = $approvalTimeline->approvalCycleApprovalStep;
            $nextApprovalCycleApprovalStep = $currentApprovalCycleApprovalStep->next;

            if ($nextApprovalCycleApprovalStep) { // check if there is next approval cycle

                $stepValue =  json_decode($nextApprovalCycleApprovalStep->approvalStep->value);
                $nextApprovalUser = '';

                if (count($stepValue->depth)) {
                    $nextApprovalUser = $creatorUser;
                    foreach ($stepValue->depth as $step) {
                        $nextApprovalUser = $nextApprovalUser->{$step};
                    }
                } else {
                    $nextApprovalUser = $this->getComplexNextUserForApprovals($stepValue->query->T, $stepValue->query->CONs,  $stepValue->query->depth);
                }

                ApprovalTimeline::create([
                    'table_name' => $approvalTimeline->table_name,
                    'record_id' => $approvalTimeline->record_id,
                    'approval_cycle_approval_step_id' => $nextApprovalCycleApprovalStep->id,
                    'user_id' => $nextApprovalUser->id, // next user in cycle
                ]);
                $this->getSuccess();
            } else {
                $this->getSuccessToastrMessage('DONE');
                // Here update table record id approval_status To Approved
                /* 
                    *
                    *
                    *
                */
            }

            // Notification for creator

            // Notification for nextApprovalUser 

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
            DB::rollBack();
            $this->getError();
        }
        return redirect()->route('approvals.index');
        // pending
        // approved
        // revert
        // reject
    }

    // Take revert action
    public function revert($id)
    {
        $approvalTimeline = ApprovalTimeline::where('id', $id)->firstOrFail();
        $model = $this->getModelFromClassName($approvalTimeline->table_name);
        $creatorUser = $model::findOrFail($approvalTimeline->record_id)->requester;

        DB::beginTransaction();
        try {

            $currentApprovalCycleApprovalStep = $approvalTimeline->approvalCycleApprovalStep;

            $previousApprovalCycleApprovalStep = $currentApprovalCycleApprovalStep->previous;

            if ($previousApprovalCycleApprovalStep) { // check if there is next approval cycle
                $stepValue =  json_decode($previousApprovalCycleApprovalStep->approvalStep->value);
                $previousApprovalUser = '';

                if (count($stepValue->depth)) {
                    $previousApprovalUser = $creatorUser;
                    foreach ($stepValue->depth as $step) {
                        $previousApprovalUser = $previousApprovalUser->{$step};
                    }
                } else {
                    $previousApprovalUser = $this->getComplexNextUserForApprovals($stepValue->query->T, $stepValue->query->CONs,  $stepValue->query->depth);
                }
                ApprovalTimeline::create([
                    'table_name' => $approvalTimeline->table_name,
                    'record_id' => $approvalTimeline->record_id,
                    'approval_cycle_approval_step_id' => $previousApprovalCycleApprovalStep->id,
                    'user_id' => $previousApprovalUser->id, // next user in cycle
                ]);
                $this->getWarningMessage('reverted_successfully');
            } else {
                // Revert approval step to creator
            }

            $approvalTimeline->update([
                'approval_status' => 'RV'
            ]);

            // Notification for creator

            // Notification for previousApprovalUser 

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
            DB::rollBack();
            $this->getError();
        }

        return redirect()->route('approvals.index');
    }

    // Take reject action
    public function reject($id)
    {
        $approvalTimeline = ApprovalTimeline::where('id', $id)->firstOrFail();

        $approvalTimeline->update([
            'approval_status' => 'RJ'
        ]);

        $this->getWarningMessage('rejected_successfully');
        // Notification for creator

        // Here update table record id approval_status To Rejcted
        /* 
            *
            *
            *
        */
        return redirect()->route('approvals.index');
    }

    public function showAllApprovalRequestsTimeline()
    {
        $approvalTimelines = ApprovalTimeline::groupby("record_id")->distinct()->paginate(env('PAGINATION_LENGTH', 5));
        $data = [];
        $projects = [];
        $sites = [];
    
    foreach($approvalTimelines as $timeline) {
        $exis = PurchaseRequest::where('id',$timeline->record_id)->get();
        if($exis) {
            $data[] = $exis;
        }
        
    }
    
    
    foreach($data as $dat) {
        foreach($dat as $pro) {
         $exis =  Project::where("id",$pro->project_id)->get();
        if($exis) {
        $projects[] = $exis;
    }
    }}
      
   
    foreach($data as $site) {
        foreach($site as $siteget) {
        $exis =  Site::where('id',$siteget->site_id)->get();
        if($exis) {
          $sites[] = $exis;
      }
      }
    }

        return view('dashboard-views.approval.all_time_lines', compact('approvalTimelines', 'projects' , 'sites'));
    }

    function fetch_data(Request $request)
    {
        // dd($request->all());
        /* Request
        [
            page, // page number
            legnth, // items per page
            search_content,
            page_type => ['index', 'trashed']
        ]
        */

        $length = request()->length ?? env('PAGINATION_LENGTH', 5);
        $searchContent = request()->search_content ?? '';
        $pageType = request()->page_type;
        $approvalTimelines = [];
            $data = [];
            $projects = [];
            $projectsID = [];
            $sites = [];       
            $purchaseId = [];     
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = ApprovalTimeline::count();
                }
                if (strlen($searchContent)) {
                    /* Project search */
                   $projectsID = Project::where(function ($query) use ($searchContent) {
                        return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                    })->pluck("id");
                    $purchaseId = PurchaseRequest::whereIn('project_id',$projectsID)->pluck('id');
                     /* End Project search */
                    
                     /* Site search */
                   
                    $siteID = Site::where(function ($query) use ($searchContent) {
                        return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->pluck("id");
                    $purchasesiteId = PurchaseRequest::whereIn('site_id',$siteID)->pluck('id');
                    
                    /* End Site search */
                    $approvalTimelines = ApprovalTimeline::
                        where(function ($query) use ($searchContent,$purchaseId,$purchasesiteId) {
                            return $query->where('table_name', 'like', '%' . $searchContent . '%')
                                    ->orWhereIn('record_id',$purchaseId)
                                    ->orWhereIn('record_id',$purchasesiteId);
                        })->groupby("record_id")->distinct()->paginate($length);
                } else {
                    $approvalTimelines = ApprovalTimeline::groupby("record_id")->distinct()->paginate($length);
                }
            }
            foreach($approvalTimelines as $timeline) {
                $exis = PurchaseRequest::where('id',$timeline->record_id)->get();
                if($exis) {
                    $data[] = $exis;
                }
                
            }
            
            
            foreach($data as $dat) {
                foreach($dat as $pro) {
                 $exis =  Project::where("id",$pro->project_id)->get();
                if($exis) {
                $projects[] = $exis;
            }
            }}
              
           
            foreach($data as $site) {
                foreach($site as $siteget) {
                $exis =  Site::where('id',$siteget->site_id)->get();
                if($exis) {
                  $sites[] = $exis;
              }
              }
            }
            return view('dashboard-views.approval.pagination_data', compact('approvalTimelines', 'pageType' , 'projects' , 'sites'))->render();
        }
    }

}
