<?php

namespace App\Http\Controllers\PurchaseRequest;

use App\Http\Controllers\Controller;
use App\Http\Requests\PurchaseRequest\CreatePurchaseRequestRequest;
use App\Http\Requests\PurchaseRequest\UpdatePurchaseRequestRequest;
use App\Models\ApprovalCycle;
use App\Models\ApprovalTimeline;
use App\Traits\ApprovalCycleTrait;
use App\Traits\ToastrTrait;
use App\Models\FamilyName;
use App\Models\Group;
use App\Models\ItemRequest;
use App\Models\PurchaseRequest;
use App\Models\SubGroup;
use App\Models\Unit;
use App\Traits\StoreFileTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PurchaseRequestsController extends Controller
{
    use ApprovalCycleTrait;
    use ToastrTrait;
    use StoreFileTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchaseRequests = PurchaseRequest::where('sent',0)->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.purchaseRequest.index', compact('purchaseRequests'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $purchaseRequests = PurchaseRequest::onlyTrashed()->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.purchaseRequest.trash', compact('purchaseRequests'));
    }

    /**
     * Return a view of the resource.
     *
     * @return \Illuminate\Support\Facades\View
     */
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
        $purchaseRequests = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = PurchaseRequest::count();
                }
                if (strlen($searchContent)) {
                    $purchaseRequests = PurchaseRequest::where('request_number', 'like', '%' . $searchContent . '%')->paginate($length);
                } else {
                    $purchaseRequests = PurchaseRequest::paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = PurchaseRequest::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $purchaseRequests = PurchaseRequest::onlyTrashed()
                        ->where(function ($query) use ($searchContent) {
                            return $query->where('request_number', 'like', '%' . $searchContent . '%');
                        })->paginate($length);
                } else {
                    $purchaseRequests = PurchaseRequest::onlyTrashed()->paginate($length);
                }
            }

            return view('dashboard-views.purchaseRequest.pagination_data', compact('purchaseRequests', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (count(session()->getOldInput())) {
            // dd(session()->getOldInput()['group_id']);
            $subGroupWithSupplierFamilyNames_id = [];
            $familyNames = FamilyName::whereIn('id', session()->getOldInput()['family_names_id'] ?? [])->get();
            $subGroups = session()->getOldInput()['group_id'] ? (Group::where('id', session()->getOldInput()['group_id'])->first()->subGroups) : [];
            $subGroupIds = [];
            $familyNames = [];
            foreach (session()->getOldInput()['family_names_id'] ?? [] as $key => $familyNameId) {
                if (!$familyNameId) {
                    array_push($subGroupIds, null);
                    array_push($familyNames, []);
                } else {
                    array_push($subGroupIds, FamilyName::where('id', $familyNameId)->first()->subGroup->id);
                    array_push($familyNames, SubGroup::where('id', $subGroupIds[$key])->first()->familyNames);
                }
            }

            session()->put('_old_input.subGroupIds', $subGroupIds);
            session()->put('_old_input.familyNames', $familyNames);
            session()->put('_old_input.subGroups', $subGroups);
        }

        $userData = collect([]);
        $user = auth()->user();
        $userData->put('name_ar', $user->name_ar);
        $userData->put('name_en', $user->name_en);

        $userData->put('project', $user->project()->with('sites')->first() ?? false);

        $userData->put('department',  $user->department ?? false);

        $userData->put('sector', $user->sector);

        $projects = [];
        if (!$userData['project'] && !$userData['department']) {
            $projects = $userData['sector']->projects;
        }
        // dd($userData['project']['sites']);
        $groups = Group::where('both', '0')->get();
        $units = Unit::all();

        return view('dashboard-views.purchaseRequest.create', compact('userData', 'groups', 'units', 'projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePurchaseRequestRequest $request)
    {
        $file = [];
        if ($request->has('file')) {
           foreach ($request->file as $fo) {
               $file[] = $this->storeFile($fo, 'uploaded-files/pr');
           }
        }
        return $file;
      //  return $request;
        $file = "";
        $user = auth()->user();
        $newRow = PurchaseRequest::count();
        $requestnumber =  date('Y') . '-' . str_pad(++$newRow, 4, '0', STR_PAD_LEFT);
        $newStoredPurchaseRequest = null;
        // Start store files


        if ($request->save) { // save only and not send
            $newStoredPurchaseRequest = PurchaseRequest::withoutEvents(function () use ($requestnumber, $request, $user) {
               // Save PR basic data
                $newPurchaseRequest = PurchaseRequest::create([
                    'request_number' => $requestnumber,
                    'requester_id' => $user->id,
                    'department_id' => $request->department_id ?? null,
                    'project_id' => $request->project_id ?? null,
                    'site_id' => $request->site_id ?? null,
                    'sector_id' => $request->sector_id,
                    'group_id' => $request->group_id,
                    "comment_reason" => $request->comment_reason
                ]);
                return $newPurchaseRequest;
            });
        } else {
            // Save and send to approve PR basic data
            $newStoredPurchaseRequest = PurchaseRequest::create([
                'request_number' => $requestnumber,
                'requester_id' => $user->id,
                'department_id' => $request->department_id ?? null,
                'project_id' => $request->project_id ?? null,
                'site_id' => $request->site_id ?? null,
                'sector_id' => $request->sector_id,
                'group_id' => $request->group_id,
                "comment_reason" => $request->comment_reason
            ]);
        }
        $file = null;
        if ($request->hasFile('file')) {
            $file = $this->storeFile($request->file, 'uploaded-files/pr');
        }

        $newStoredPurchaseRequest->update([
            "file" => $file
        ]);

        // // Save PR Items
        foreach ($request->items as $key => $item) {
            $newStoredPurchaseRequest->itemRequests()->create([
                'family_name_id' => $request->family_names_id[$key],
                'specification' => $request->specifications[$key],
                'comment' => $request->comments[$key],
                'priority' => $request->priorities[$key],
                'quantity' => $request->quantities[$key],
                'stock_quantity' => $request->stock_quantities[$key],
                'actual_quantity' => $request->actual_quantities[$key],
                'unit_id' => $request->units_id[$key],
            ]);
        }


        // Notification part (In the future)
        // Start toastr notification
        Toastr()->success(
            trans('site.added_successfully'),
            trans("site.Success"),
            [
                "closeButton" => true,
                "progressBar" => true,
                "positionClass" => app()->getLocale() == 'en' ? "toast-top-right" : "toast-top-left",
                "timeOut" => "10000",
                "extendedTimeOut" => "10000",
            ]
        );
        // End toastr notification

        return redirect()->route('purchase-request.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseRequest $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseRequest $purchaseRequest)
    {
        return json_decode(collect([
            'PurchaseRequest' => json_decode($purchaseRequest),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseRequest $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseRequest $purchaseRequest)
    {
        if (count(session()->getOldInput())) {
            // dd(session()->getOldInput());
            $subGroupWithSupplierFamilyNames_id = [];
            $familyNames = FamilyName::whereIn('id', session()->getOldInput()['family_names_id'] ?? [])->get();
            $subGroups = session()->getOldInput()['group_id'] ? (Group::where('id', session()->getOldInput()['group_id'])->first()->subGroups) : [];
            $subGroupIds = [];
            $familyNames = [];
            foreach (session()->getOldInput()['family_names_id'] ?? [] as $key => $familyNameId) {
                if (!$familyNameId) {
                    array_push($subGroupIds, null);
                    array_push($familyNames, []);
                } else {
                    array_push($subGroupIds, FamilyName::where('id', $familyNameId)->first()->subGroup->id);
                    array_push($familyNames, SubGroup::where('id', $subGroupIds[$key])->first()->familyNames);
                }
            }

            session()->put('_old_input.subGroupIds', $subGroupIds);
            session()->put('_old_input.familyNames', $familyNames);
            session()->put('_old_input.subGroups', $subGroups);
        }

        $userData = collect([]);
        $user = auth()->user();
        $userData->put('name_ar', $user->name_ar);
        $userData->put('name_en', $user->name_en);

        $userData->put('project', $user->project()->with('sites')->first() ?? false);

        $userData->put('department',  $user->department ?? false);

        $userData->put('sector', $user->sector);

        $projects = [];
        if (!$userData['project'] && !$userData['department']) {
            $projects = $userData['sector']->projects;
        }

        $units = Unit::all();
        $mytime = Carbon::now()->format('d-m-Y');
        $subGroups = SubGroup::where('group_id', $purchaseRequest->group_id)->get();
        $groups = Group::where('both', '0')->get();
        $familyNames = FamilyName::all();
        return view('dashboard-views.purchaseRequest.edit', compact(
            'purchaseRequest',
            'groups',
            'userData',
            'mytime',
            'units',
            'user',
            'subGroups',
            'familyNames',
            'projects'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseRequest $purchaseRequest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseRequestRequest $request, PurchaseRequest $purchaseRequest)
    {
            $purRequest = PurchaseRequest::find($purchaseRequest->id);
        // Start transaction
        DB::beginTransaction();
        try {
            // Save PR Main Component
            $purchaseRequest->update([
                'department_id' => $request->department_id ?? null,
                'project_id' => $request->project_id ?? null,
                'site_id' => $request->site_id ?? null,
                'sector_id' => $request->sector_id,
                'group_id' => $request->group_id,

            ]);

            // Start update item
            $retrivedItemsRequest = [];
            foreach ($request->items as  $key => $item) {
                array_push($retrivedItemsRequest, $request->ids[$key]);
            }
            $ItemsRequest = ItemRequest::where('purchase_request_id', $purchaseRequest->id)->pluck('id')->toArray();

            $deletedItemRequest = array_diff($ItemsRequest, $retrivedItemsRequest);
            ItemRequest::whereIn('id', $deletedItemRequest)->delete();
            unset($deletedItemRequest, $ItemsRequest, $retrivedItemsRequest);
            $file = $purRequest->file;
                if ($request->hasFile('file')) {
                    $file = $this->storeFile($request->file, 'uploaded-files/pr');
                }

                $purchaseRequest->update([
                    "file" => $file
                ]);
            foreach ($request->items as $key => $item) {
                if ($request->ids[$key]) {
                    ItemRequest::where('id', $request->ids[$key])->update([
                        'family_name_id' => $request->family_names_id[$key],
                        'specification' => $request->specifications[$key],
                        'comment' => $request->comments[$key],
                        'priority' => $request->priorities[$key],
                        'quantity' => $request->quantities[$key],
                        'stock_quantity' => $request->stock_quantities[$key],
                        'actual_quantity' => $request->actual_quantities[$key],
                        'unit_id' => $request->units_id[$key],
                    ]);
                } else {
                    ItemRequest::create([
                        'purchase_request_id' => $purchaseRequest->id,
                        'family_name_id' => $request->family_names_id[$key],
                        'specification' => $request->specifications[$key],
                        'comment' => $request->comments[$key],
                        'priority' => $request->priorities[$key],
                        'quantity' => $request->quantities[$key],
                        'stock_quantity' => $request->stock_quantities[$key],
                        'actual_quantity' => $request->actual_quantities[$key],
                        'unit_id' => $request->units_id[$key],
                    ]);
                }
            }
            // End update items

            DB::commit();
            $this->getSuccessToastrMessage('added_successfully');
            // Notification part (In the future)
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
        }
        return redirect()->route('purchase-request.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $purchaseRequest = PurchaseRequest::findOrFail($request->purchaseRequest_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $purchaseRequest->forceDelete();
        } catch (\Illuminate\Database\QueryException $e) { // Handle integrity constraint violation
            $availableToDelete = false;
            if ($e->errorInfo[0] == 23000) {
                // $errorMessage = '';
                $errorMessage = $e->getMessage();
            } else {
                $errorMessage = 'DB error';
            }
        } finally {
            DB::rollBack();
        }

        // End check if record can be deleted
        $purchaseRequest = PurchaseRequest::findOrFail($request->purchaseRequest_id);
        if ($availableToDelete) {
            $status = true;
            $purchaseRequest->delete();
        } else {
            $status = false;
        }

        return json_encode([
            'status' => $status,
            'errorMessage' => $errorMessage,
        ]);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */

    public function restore(Request $request)
    {
        $purchaseRequest = PurchaseRequest::withTrashed()->where('id', $request->purchaseRequest_id)->firstOrFail();
        $status = null;

        if ($purchaseRequest->trashed()) {
            $purchaseRequest->restore();

            // Notification part (In the future)

            $status = true;
        } else {
            $status = false;
        }
        return json_encode([
            'status' => $status,
            'errorMessage' => 'already founded',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function permanent_delete(Request $request)
    {
        // Start transaction
        DB::beginTransaction();
        try {

            $purchaseRequest = PurchaseRequest::onlyTrashed()->findOrFail($request->purchaseRequest_id);

            $deletedPurchaseRequest = clone $purchaseRequest; // used in notifications

            $purchaseRequest->forceDelete();

            $errorMessage = '';
            $status = null;

            // Notification part (In the future)

            $status = true;

            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) { // Handle integrity constraint violation
            DB::rollBack();

            if ($e->errorInfo[0] == 23000) {
                // $errorMessage = '';
                $errorMessage = $e->getMessage();
            } else {
                $errorMessage = 'DB error';
            }

            $status = false;
        }
        return json_encode([
            'status' => $status,
            'errorMessage' => $errorMessage,
        ]);
    }

    // Send Purchase request that saved only and now will send for approvals cycles
    public function sendForApproveSavedPR(Request $request)
    {
        $purchaseRequest = PurchaseRequest::findorFail($request->purchaseRequest_id);
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

        return json_encode([
            'status' => true,
            'code' => 'PR_sent',
        ]);


    }
}
