<?php

namespace App\Http\Controllers\Job;

use App\Http\Controllers\Controller;
use App\Http\Requests\job\CreateJobGradeRequest;
use App\Http\Requests\job\UpdateJobGradeRequest;
use App\Traits\ToastrTrait;
use App\Models\JobCode;
use App\Models\JobGrade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobGradeController extends Controller
{
    use ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobGrades = JobGrade::with('jobCode')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.job.grade.index', compact('jobGrades'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $jobGrades = JobGrade::onlyTrashed()->with('jobCode')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.job.grade.trash', compact('jobGrades'));
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
        $jobGrades = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = JobGrade::count();
                }
                if (strlen($searchContent)) {
                    $jobGrades = JobGrade::where('grade', 'like', '%' . $searchContent . '%')->with('jobCode')->paginate($length);
                } else {
                    $jobGrades = JobGrade::with('jobCode')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = JobGrade::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $jobGrades = JobGrade::onlyTrashed()->where('grade', 'like', '%' . $searchContent . '%')->with('jobCode')->paginate($length);
                } else {
                    $jobGrades = JobGrade::onlyTrashed()->with('jobCode')->paginate($length);
                }
            }

            return view('dashboard-views.job.grade.pagination_data', compact('jobGrades', 'pageType'))->render();
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
        return view('dashboard-views.job.grade.create', compact('jobCodes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateJobGradeRequest $request)
    {
        $newStoredJobGrade = JobGrade::create(
            $request->except('_token'),
        );

        // Notification part (In the future)
        // Start toastr notification
        $this->getSuccessToastrMessage('added_successfully');
        // End toastr notification

        return redirect()->route('job-grade.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobGrade $jobGrade
     * @return \Illuminate\Http\Response
     */
    public function show(JobGrade $jobGrade)
    {
        return json_decode(collect([
            'JobGrade' => json_decode($jobGrade),
            'JobGrade JobCode' => json_decode($jobGrade->jobCode),
            'JobGrade Department' => json_decode($jobGrade->jobCode->department),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobGrade $jobGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(JobGrade $jobGrade)
    {
        $jobCodes = JobCode::all();
        return view('dashboard-views.job.grade.edit', compact('jobGrade', 'jobCodes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobGrade $jobGrade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJobGradeRequest $request, JobGrade $jobGrade)
    {
        $updatedJobGrade = $jobGrade->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('updated_successfully');
        // End toastr notification

        return redirect()->route('job-grade.index');
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
        $jobGrade = JobGrade::findOrFail($request->job_grade_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $jobGrade->forceDelete();
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
        $jobGrade = JobGrade::findOrFail($request->job_grade_id);

        if ($availableToDelete) {
            $status = true;
            $jobGrade->delete();
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
        $jobGrade = JobGrade::withTrashed()->where('id', $request->job_grade_id)->firstOrFail();
        $status = null;

        if ($jobGrade->trashed()) {
            $jobGrade->restore();

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

            $jobGrade = JobGrade::onlyTrashed()->findOrFail($request->job_grade_id);

            $deletedJobGrade = clone $jobGrade; // used in notifications

            $jobGrade->forceDelete();

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
