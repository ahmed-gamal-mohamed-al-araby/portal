<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\CreateProjectRequest;
use App\Http\Requests\Project\UpdateProjectRequest;
use App\Models\Group;
use App\Traits\ToastrTrait;
use App\Models\Project;
use App\Models\Sector;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    use ToastrTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('completed', false)->with('manager')->with('sector')->with('sites')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.project.index', compact('projects'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $projects = Project::onlyTrashed()->with('manager')->with('sector')->with('sites')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.project.trash', compact('projects'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function completed_index()
    {
        $projects = Project::where('completed', true)->with('manager')->with('sector')->with('sites')->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.project.completed', compact('projects'));
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
            page_type => ['index', 'trashed', 'completed']
        ]
        */

        $length = request()->length ?? env('PAGINATION_LENGTH', 5);
        $searchContent = request()->search_content ?? '';
        $pageType = request()->page_type;
        $projects = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = Project::where('completed', false)->count();
                }
                if (strlen($searchContent)) {
                    $projects = Project::where('completed', false)->where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->with('manager')->with('sector')->with('sites')->paginate($length);
                } else {
                    $projects = Project::where('completed', false)->with('manager')->with('sector')->with('sites')->paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = Project::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $projects = Project::onlyTrashed()
                        ->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->with('manager')->with('sector')->with('sites')
                        ->paginate($length);
                } else {
                    $projects = Project::onlyTrashed()->with('manager')->with('sector')->with('sites')->paginate($length);
                }
            } else if ($pageType == 'completed') {
                if ($length == -1) {
                    $length = Project::where('completed', true)->count();
                }
                if (strlen($searchContent)) {
                    $projects = Project::where('completed', true)->where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->with('manager')->with('sector')->with('sites')->paginate($length);
                } else {
                    $projects = Project::where('completed', true)->with('manager')->with('sector')->with('sites')->paginate($length);
                }
            }

            return view('dashboard-views.project.pagination_data', compact('projects', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sectors = Sector::all();
        $users = User::all();
        $groups = Group::all();
        return view('dashboard-views.project.create', compact('sectors', 'users','groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $newStoredProject = Project::create(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('added_successfully');
        // End toastr notification

        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return json_decode(collect([
            'Project' => json_decode($project),
            'Project Manager' => json_decode($project->manager),
            'Project Sector' => json_decode($project->sector),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $sectors = Sector::all();
        $users = User::all();
        return view('dashboard-views.project.edit', compact('project', 'sectors', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $updatedProject = $project->update(
            $request->except('_token'),
        );

        // Notification part (In the future)

        // Start toastr notification
        $this->getSuccessToastrMessage('updated_successfully');
        // End toastr notification

        return redirect()->route('project.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */

    public function trash(Request $request)
    {
        $project = Project::findOrFail($request->project_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $project->forceDelete();
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
        $project = Project::findOrFail($request->project_id);
        if ($availableToDelete) {
            $status = true;
            $project->delete();
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
        $project = Project::withTrashed()->where('id', $request->project_id)->firstOrFail();
        $status = null;

        if ($project->trashed()) {
            $project->restore();

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

            $project = Project::onlyTrashed()->findOrFail($request->project_id);

            $deletedProject = clone $project; // used in notifications

            $project->forceDelete();

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

    public function fetch_related_site(Request $request){
        $project = Project::find($request->projectId);
        $status = null;
        $sites = [];
        if($project) {
            $status = true;
            $sites = $project->sites;
        } else {
            $status = false;
        }

        return json_encode([
            'status' => $status,
            'sites' => $sites,
        ]);
    }
}
