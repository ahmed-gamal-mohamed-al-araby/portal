<?php

namespace App\Http\Controllers\Governorate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Governorate\CreateGovernorateRequest;
use App\Http\Requests\Governorate\UpdateGovernorateRequest;
use App\Traits\ToastrTrait;
use App\Models\Governorate;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GovernorateController extends Controller
{
    use ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $governorates = Governorate::with('country')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.governorate.index', compact('governorates'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $governorates = Governorate::onlyTrashed()->with('country')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.governorate.trash', compact('governorates'));
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
        $governorates = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = Governorate::count();
                }
                if (strlen($searchContent)) {
                    $governorates = Governorate::where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->with('country')->paginate($length);
                } else {
                    $governorates = Governorate::with('country')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = Governorate::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $governorates = Governorate::onlyTrashed()
                        ->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->with('country')
                        ->paginate($length);
                } else {
                    $governorates = Governorate::onlyTrashed()->with('country')->paginate($length);
                }
            }

            return view('dashboard-views.governorate.pagination_data', compact('governorates', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('dashboard-views.governorate.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGovernorateRequest $request)
    {
        $newStoredGovernorate = Governorate::create(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('added_successfully');
        // End toastr notification

        return redirect()->route('governorate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Governorate $governorate
     * @return \Illuminate\Http\Response
     */
    public function show(Governorate $governorate)
    {
        return json_decode(collect([
            'Governorate' => json_decode($governorate),
            'Governorate Country' => json_decode($governorate->country),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Governorate $governorate
     * @return \Illuminate\Http\Response
     */
    public function edit(Governorate $governorate)
    {
        $countries = Country::all();
        return view('dashboard-views.governorate.edit', compact('governorate', 'countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Governorate $governorate
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGovernorateRequest $request, Governorate $governorate)
    {
        $updatedGovernorate = $governorate->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('updated_successfully');
        // End toastr notification

        return redirect()->route('governorate.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */

    public function trash(Request $request)
    {
        $governorate = Governorate::findOrFail($request->governorate_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $governorate->forceDelete();
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
        $governorate = Governorate::findOrFail($request->governorate_id);
        if ($availableToDelete) {
            $status = true;
            $governorate->delete();
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
        $governorate = Governorate::withTrashed()->where('id', $request->governorate_id)->firstOrFail();
        $status = null;

        if ($governorate->trashed()) {
            $governorate->restore();

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

            $governorate = Governorate::onlyTrashed()->findOrFail($request->governorate_id);

            $deletedGovernorate = clone $governorate; // used in notifications

            $governorate->forceDelete();

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
