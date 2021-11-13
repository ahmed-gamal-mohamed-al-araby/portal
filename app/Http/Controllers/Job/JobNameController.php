<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\job\CreateJobNameRequest;
use App\Http\Requests\job\UpdateJobNameRequest;
use App\Traits\ToastrTrait;
use App\Models\JobCode;
use App\Models\JobName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function GuzzleHttp\Promise\all;

class JobNameController extends Controller
{
    use ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobNames = JobName::with('jobCode')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.job.name.index', compact('jobNames'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $jobNames = JobName::onlyTrashed()->with('jobCode')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.job.name.trash', compact('jobNames'));
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
        $jobNames = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = JobName::count();
                }
                if (strlen($searchContent)) {
                    $jobNames = JobName::where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->with('jobCode')->paginate($length);
                } else {
                    $jobNames = JobName::with('jobCode')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = JobName::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $jobNames = JobName::onlyTrashed()
                        ->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->with('jobCodes')
                        ->paginate($length);
                } else {
                    $jobNames = JobName::onlyTrashed()->with('jobCode')->paginate($length);
                }
            }

            return view('dashboard-views.job.name.pagination_data', compact('jobNames', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobCodes = JobCode::all();
        return view('dashboard-views.job.name.create', compact('jobCodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJobNameRequest $request)
    {
        $newStoredJobName = JobName::create(
            $request->except('_token'),
        );

        // Notification part (In the future)
        // Start toastr notification
        $this->getSuccessToastrMessage('added_successfully');
        // End toastr notification

        return redirect()->route('job-name.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobName $jobName
     * @return \Illuminate\Http\Response
     */
    public function show(JobName $jobName)
    {
        return json_decode(collect([
            'JobName' => json_decode($jobName),
            'JobName JobCode' => json_decode($jobName->jobCode),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobName $jobName
     * @return \Illuminate\Http\Response
     */
    public function edit(JobName $jobName)
    {
        $jobCodes = JobCode::all();
        return view('dashboard-views.job.name.edit', compact('jobName', 'jobCodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobName $jobName
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobNameRequest $request, JobName $jobName)
    {
        $updatedJobName = $jobName->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('updated_successfully');
        // End toastr notification

        return redirect()->route('job-name.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        // dd($request->all());
        $jobName = JobName::findOrFail($request->job_name_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $jobName->forceDelete();
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
        $jobName = JobName::findOrFail($request->job_name_id);

        if ($availableToDelete) {
            $status = true;
            $jobName->delete();
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
        $jobName = JobName::withTrashed()->where('id', $request->job_name_id)->firstOrFail();
        $status = null;

        if ($jobName->trashed()) {
            $jobName->restore();

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

            $jobName = JobName::onlyTrashed()->findOrFail($request->job_name_id);

            $deletedJobName = clone $jobName; // used in notifications

            $jobName->forceDelete();

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
