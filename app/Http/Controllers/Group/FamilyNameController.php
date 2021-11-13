<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\FamilyName\CreateSubFamilyNameRequest;
use App\Http\Requests\FamilyName\UpdateSubFamilyNameRequest;
use App\Traits\ToastrTrait;
use App\Models\FamilyName;
use App\Models\SubGroup;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyNameController extends Controller
{
    use ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $familyNames = FamilyName::where('both', 0)->with('subGroup')->paginate(env('PAGINATION_LENGTH', 5));
        return view('dashboard-views.familyName.index', compact('familyNames'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $familyNames = FamilyName::where('both', 0)->onlyTrashed()->with('subGroup')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.familyName.trash', compact('familyNames'));
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
        $familyNames = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = FamilyName::count();
                }
                if (strlen($searchContent)) {
                    $familyNames = FamilyName::where('both', 0)->where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->with('subGroup')->paginate($length);
                } else {
                    $familyNames = FamilyName::where('both', 0)->with('subGroup')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = FamilyName::where('both', 0)->onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $familyNames = FamilyName::where('both', 0)->onlyTrashed()
                        ->where('both', 0)->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->with('subGroup')
                        ->paginate($length);
                } else {
                    $familyNames = FamilyName::where('both', 0)->onlyTrashed()->with('subGroup')->paginate($length);
                }
            }

            return view('dashboard-views.familyName.pagination_data', compact('familyNames', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $groups =   Group::all();
        $subGroups = SubGroup::where('both', 0)->get();
        return view('dashboard-views.familyName.create', compact('subGroups','groups'));
    }

    public function fetch_related_job(Request $request){
        $subGroup = Group::find($request->groupId);
        $status = null;
        $subGroups = [];
        if($subGroup) {
            $status = true;
            $subGroups = $subGroup->subGroups;
        } else {
            $status = false;
        }

        return json_encode([
            'status' => $status,
            'subGroups' => $subGroups,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSubFamilyNameRequest $request)
    {
        $newStoredFamilyName = FamilyName::create(
            $request->except('_token','group_id'),
        );

        $familyNameCivil = FamilyName::create([
            'name_ar' => $newStoredFamilyName->name_ar,
            'name_en' => $newStoredFamilyName->name_en,
            'sub_group_id' => SubGroup::where('name_en', $newStoredFamilyName->subGroup->name_en)
                ->orWhere('group_id', Group::where('code', 'C_Civil')->first()->id)
                ->first()->id,
            'both' => 1,
        ]);

        $familyNameMEP = FamilyName::create([
            'name_ar' => $newStoredFamilyName->name_ar,
            'name_en' => $newStoredFamilyName->name_en,
            'sub_group_id' => 1,
            'both' => 1,
        ]);

        // Notification part (In the future)
        // Start toastr notification
        $this->getSuccessToastrMessage('added_successfully');
        // End toastr notification

        return redirect()->route('family-name.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FamilyName  $familyName
     * @return \Illuminate\Http\Response
     */
    public function show(FamilyName $familyName)
    {
        return json_decode(collect([
            'familyName' => json_decode($familyName),
            'subGroup' => json_decode($familyName->subGroup),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FamilyName  $familyName
     * @return \Illuminate\Http\Response
     */
    public function edit(FamilyName $familyName)
    {
        $subGroups = SubGroup::all();
        return view('dashboard-views.familyName.edit', compact('subGroups', 'familyName'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FamilyName  $familyName
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubFamilyNameRequest $request, FamilyName $familyName)
    {
        $updatedFmailyName = $familyName->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('updated_successfully');
        // End toastr notification

        return redirect()->route('family-name.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */

    public function trash(Request $request)
    {
        $familyName = FamilyName::findOrFail($request->family_name_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $familyName->forceDelete();
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
        $familyName = FamilyName::findOrFail($request->family_name_id);
        if ($availableToDelete) {
            $status = true;
            $familyName->delete();
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
        $familyName = FamilyName::withTrashed()->where('id', $request->family_name_id)->firstOrFail();
        $status = null;

        if ($familyName->trashed()) {
            $familyName->restore();

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

            $familyName = FamilyName::onlyTrashed()->findOrFail($request->family_name_id);

            $deletedFamilyName = clone $familyName; // used in notifications

            $familyName->forceDelete();

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
}
