<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubGroup\CreateSubGroupRequest;
use App\Http\Requests\SubGroup\UpdateSubGroupRequest;
use App\Traits\ToastrTrait;
use App\Models\Group;
use App\Models\SubGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubGroupController extends Controller
{
    use ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subGroups = SubGroup::where('both', 0)->with('group')->paginate(env('PAGINATION_LENGTH', 5));
        return view('dashboard-views.subGroup.index', compact('subGroups'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $subGroups = SubGroup::where('both', 0)->onlyTrashed()->with('group')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.subGroup.trash', compact('subGroups'));
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
        $subGroups = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = SubGroup::count();
                }
                if (strlen($searchContent)) {
                    $subGroups = SubGroup::where('both', 0)->where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->with('group')->paginate($length);
                } else {
                    $subGroups = SubGroup::where('both', 0)->with('group')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = SubGroup::where('both', 0)->onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $subGroups = SubGroup::onlyTrashed()
                        ->where('both', 0)->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->with('group')
                        ->paginate($length);
                } else {
                    $subGroups = SubGroup::where('both', 0)->onlyTrashed()->with('group')->paginate($length);
                }
            }

            return view('dashboard-views.subGroup.pagination_data', compact('subGroups', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups = Group::all();
        return view('dashboard-views.subGroup.create', compact('groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubGroupRequest $request)
    {

        $newStoredSubGroup = SubGroup::create(
            $request->except('_token'),
        );

        // Notification part (In the future)
        // Start toastr notification
        $this->getSuccessToastrMessage('added_successfully');
        // End toastr notification

        return redirect()->route('sub-group.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function show(SubGroup $subGroup)
    {
        return json_decode(collect([
            'subGroup' => json_decode($subGroup),
            'Group' => json_decode($subGroup->group),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(SubGroup $subGroup)
    {
        $groups = Group::all();
        return view('dashboard-views.subGroup.edit', compact('subGroup', 'groups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubGroup  $subGroup
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubGroupRequest $request, SubGroup $subGroup)
    {
        $group = $subGroup->group;
        // Start test if there is no dependencies for this subGroup in Civil & MEP
        if ($group->code == 'C_CivilMEP') {
            $subGropCivil = SubGroup::where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_Civil')->first()->id)->first();
            $subGropMEP = SubGroup::where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_MEP')->first()->id)->first();

            $subGropCivil->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en
            ]);
            $subGropMEP->update([
                'name_ar' => $request->name_ar,
                'name_en' => $request->name_en
            ]);
        }
        // End test if there is no dependencies for this subGroup in Civil & MEP

        $updatedSubGroup = $subGroup->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('updated_successfully');
        // End toastr notification

        return redirect()->route('sub-group.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */

    public function trash(Request $request)
    {
        $subGroup = SubGroup::findOrFail($request->sub_group_id);
        $group = $subGroup->group;

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            // Start test if there is no dependencies for this subGroup in Civil & MEP
            if ($group->code == 'C_CivilMEP') {
                $subGropCivil = SubGroup::where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_Civil')->first()->id)->first();
                $subGropMEP = SubGroup::where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_MEP')->first()->id)->first();

                $subGropCivil->forceDelete();
                $subGropMEP->forceDelete();
            }
            // End test if there is no dependencies for this subGroup in Civil & MEP

            $subGroup->forceDelete();
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
        $subGroup = SubGroup::findOrFail($request->sub_group_id);
        if ($availableToDelete) {
            $status = true;
            $subGroup->delete();
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
        $subGroup = SubGroup::withTrashed()->where('id', $request->sub_group_id)->firstOrFail();
        $status = null;

        if ($subGroup->trashed()) {
            $subGroup->restore();

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function permanent_delete(Request $request)
    {
        // Start transaction
        DB::beginTransaction();
        try {
            $subGroup = SubGroup::onlyTrashed()->findOrFail($request->sub_group_id);
            $group = $subGroup->group;

            $deletedsubGroup = clone $subGroup; // used in notifications

            $subGroup->forceDelete();
            // Start test if there is no dependencies for this subGroup in Civil & MEP
            if ($group->code == 'C_CivilMEP') {
                $subGropCivil = SubGroup::onlyTrashed()->where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_Civil')->first()->id)->first();
                $subGropMEP = SubGroup::onlyTrashed()->where('name_en', $subGroup->name_en)->where('group_id', Group::where('code', 'C_MEP')->first()->id)->first();
                $subGropCivil->forceDelete();
                $subGropMEP->forceDelete();
            }
            // End test if there is no dependencies for this subGroup in Civil & MEP

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

    public function fetch_related_family_name(Request $request)
    {
        $subGroup = SubGroup::find($request->subGroupId);
        $status = null;
        $familyNames = [];
        if ($subGroup) {
            $status = true;
            $familyNames = $subGroup->familyNames;
        } else {
            $status = false;
        }

        return json_encode([
            'status' => $status,
            'familyNames' => $familyNames,
        ]);
    }
}
