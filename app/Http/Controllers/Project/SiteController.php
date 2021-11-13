<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\CreateSiteRequest;
use App\Http\Requests\Site\UpdateSiteRequest;
use App\Models\Project;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Site::with('project')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.site.index', compact('sites'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $sites = Site::onlyTrashed()->with('project')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.site.trash', compact('sites'));
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
        $sites = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = Site::count();
                }
                if (strlen($searchContent)) {
                    $sites = Site::where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->with('project')->paginate($length);
                } else {
                    $sites = Site::with('project')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = Site::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $sites = Site::onlyTrashed()
                        ->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->with('project')->paginate($length);
                } else {
                    $sites = Site::onlyTrashed()->with('project')->paginate($length);
                }
            }

            return view('dashboard-views.site.pagination_data', compact('sites', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::all();
        return view('dashboard-views.site.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSiteRequest $request)
    {
        $newStoredSite = Site::create(
            $request->except('_token'),
        );

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

        return redirect()->route('site.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Site $site
     * @return \Illuminate\Http\Response
     */
    public function show(Site $site)
    {
        return json_decode(collect([
            'Site' => json_decode($site),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Site $site
     * @return \Illuminate\Http\Response
     */
    public function edit(Site $site)
    {
        $projects = Project::all();
        return view('dashboard-views.site.edit', compact('site', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Site $site
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSiteRequest $request, Site $site)
    {
        $updatedSite = $site->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        Toastr()->success(
            trans('site.updated_successfully'),
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

        return redirect()->route('site.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $site = Site::findOrFail($request->site_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $site->forceDelete();
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
        $site = Site::findOrFail($request->site_id);
        if ($availableToDelete) {
            $status = true;
            $site->delete();
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
        $site = Site::withTrashed()->where('id', $request->site_id)->firstOrFail();
        $status = null;

        if ($site->trashed()) {
            $site->restore();

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

            $site = Site::onlyTrashed()->findOrFail($request->site_id);

            $deletedSite = clone $site; // used in notifications

            $site->forceDelete();

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
