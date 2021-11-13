<?php

namespace App\Http\Controllers\Sector;

use App\Http\Controllers\Controller;
use App\Http\Requests\Sector\CreateSectorRequest;
use App\Http\Requests\Sector\UpdateSectorRequest;
use App\Traits\ToastrTrait;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SectorController extends Controller
{
    use ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sectors = Sector::with('head')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.sector.index', compact('sectors'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $sectors = Sector::onlyTrashed()->with('head')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.sector.trash', compact('sectors'));
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
        $sectors = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = Sector::count();
                }
                if (strlen($searchContent)) {
                    $sectors = Sector::where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->with('head')->paginate($length);
                } else {
                    $sectors = Sector::with('head')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = Sector::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $sectors = Sector::onlyTrashed()
                        ->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->with('head')->paginate($length);
                } else {
                    $sectors = Sector::onlyTrashed()->with('head')->paginate($length);
                }
            }

            return view('dashboard-views.sector.pagination_data', compact('sectors', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('dashboard-views.sector.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSectorRequest $request)
    {
        $newStoredSector = Sector::create(
            $request->except('_token'),
        );

        // Notification part (In the future)
        // Start toastr notification
        $this->getSuccessToastrMessage('added_successfully');
        // End toastr notification

        return redirect()->route('sector.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function show(Sector $sector)
    {
        return json_decode(collect([
            'Sector' => json_decode($sector),
            'Sector Head Data' => json_decode($sector->head),
            'Sector Departments' => json_decode($sector->departments),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function edit(Sector $sector)
    {
        $users = User::all();
        return view('dashboard-views.sector.edit', compact('sector', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sector  $sector
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectorRequest $request, Sector $sector)
    {
        $updatedSector = $sector->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('updated_successfully');
        // End toastr notification

        return redirect()->route('sector.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $sector = Sector::findOrFail($request->sector_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $sector->forceDelete();
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
        $sector = Sector::findOrFail($request->sector_id);
        if ($availableToDelete) {
            $status = true;
            $sector->delete();
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
        $sector = Sector::withTrashed()->where('id', $request->sector_id)->firstOrFail();
        $status = null;

        if ($sector->trashed()) {
            $sector->restore();

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

            $sector = Sector::onlyTrashed()->findOrFail($request->sector_id);

            $deletedsector = clone $sector; // used in notifications

            $sector->forceDelete();

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

    public function fetch_related_sector(Request $request){
        $sector = Sector::find($request->sectorId);
        $status = null;
        $projects = [];
        $departments = [];
        if($sector) {
            $status = true;
            $projects = $sector->projects;
            $departments = $sector->departments;
        } else {
            $status = false;
        }

        return json_encode([
            'status' => $status,
            'projects' => $projects,
            'departments' => $departments
        ]);
    }
}
