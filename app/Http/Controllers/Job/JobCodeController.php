<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\job\CreateJobCodeRequest;
use App\Http\Requests\job\UpdateJobCodeRequest;
use App\Traits\ToastrTrait;
use App\Models\Department;
use App\Models\JobCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\returnSelf;

class JobCodeController extends Controller
{
    use ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobCodes = JobCode::with('department')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.job.code.index', compact('jobCodes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $jobCodes = JobCode::onlyTrashed()->with('department')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.job.code.trash', compact('jobCodes'));
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
        $jobCodes = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = JobCode::count();
                }
                if (strlen($searchContent)) {
                    $jobCodes = JobCode::where('code', 'like', '%' . $searchContent . '%')->with('department')->paginate($length);
                } else {
                    $jobCodes = JobCode::with('department')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = JobCode::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $jobCodes = JobCode::onlyTrashed()->where('code', 'like', '%' . $searchContent . '%')->with('department')->paginate($length);
                } else {
                    $jobCodes = JobCode::onlyTrashed()->with('department')->paginate($length);
                }
            }

            return view('dashboard-views.job.code.pagination_data', compact('jobCodes', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('dashboard-views.job.code.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJobCodeRequest $request)
    {
        $newStoredJobCode = JobCode::create(
            $request->except('_token'),
        );

        // Notification part (In the future)
        // Start toastr notification
        $this->getSuccessToastrMessage('added_successfully');
        // End toastr notification

        return redirect()->route('job-code.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobCode $jobCode
     * @return \Illuminate\Http\Response
     */
    public function show(JobCode $jobCode)
    {
        return json_decode(collect([
            'JobCode' => json_decode($jobCode),
            'JobCode Grades' => json_decode($jobCode->jobGrades),
            'JobCode Names' => json_decode($jobCode->jobNames),
            'JobCode Department' => json_decode($jobCode->department),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobCode $jobCode
     * @return \Illuminate\Http\Response
     */
    public function edit(JobCode $jobCode)
    {
        $departments = Department::all();
        return view('dashboard-views.job.code.edit', compact('jobCode', 'departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobCode $jobCode
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobCodeRequest $request, JobCode $jobCode)
    {
        $updatedJobCode = $jobCode->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('updated_successfully');
        // End toastr notification

        return redirect()->route('job-code.index');
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
        $jobCode = JobCode::findOrFail($request->job_code_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $jobCode->forceDelete();
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
        $jobCode = JobCode::findOrFail($request->job_code_id);
        if ($availableToDelete) {
            $status = true;
            $jobCode->delete();
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
        $jobCode = JobCode::withTrashed()->where('id', $request->job_code_id)->firstOrFail();
        $status = null;

        if ($jobCode->trashed()) {
            $jobCode->restore();

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

            $jobCode = JobCode::onlyTrashed()->findOrFail($request->job_code_id);

            $deletedJobCode = clone $jobCode; // used in notifications

            $jobCode->forceDelete();

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

    public function fetch_related_job_code(Request $request){
        $jobCode = JobCode::find($request->jobCodeId);
        $status = null;
        $jobGrades = [];
        $jobNames = [];
        if($jobCode) {
            $status = true;
            $jobGrades = $jobCode->jobGrades;
            $jobNames = $jobCode->jobNames;
        } else {
            $status = false;
        }

        return json_encode([
            'status' => $status,
            'jobGrades' => $jobGrades,
            'jobNames' => $jobNames
        ]);
    }
}
