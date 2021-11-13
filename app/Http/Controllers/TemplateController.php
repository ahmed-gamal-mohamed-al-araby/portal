<?php

namespace App\Http\Controllers\ModelName;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModelName\CreateModelNameRequest;
use App\Http\Requests\ModelName\UpdateModelNameRequest;
use App\Models\ModelName;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TemplateController extends Controller
{
    /*
        1. ModelName replaced with your model name start with capital letter as Country
        2. model_Name replaced with your model name start with small letter as country
        3. Plural_Model__Name replaced with your model name start with small letter as Plural_Model__Name
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Plural_Model__Name = ModelName::paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.model_Name.index', compact('Plural_Model__Name'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function trash_index()
    {
        $Plural_Model__Name = ModelName::onlyTrashed()->paginate(env('PAGINATION_LENGTH', 5));

        return view('dashboard-views.model_Name.trash', compact('Plural_Model__Name'));
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
        $Plural_Model__Name = [];
        if ($request->ajax()) {
            if ($pageType == 'index') {
                if ($length == -1) {
                    $length = ModelName::count();
                }
                if (strlen($searchContent)) {
                    $Plural_Model__Name = ModelName::where('name_ar', 'like', '%' . $searchContent . '%')->orWhere('name_en', 'like', '%' . $searchContent . '%')->paginate($length);
                } else {
                    $Plural_Model__Name = ModelName::paginate($length);
                }
            } else if ($pageType == 'trashed') {
                if ($length == -1) {
                    $length = ModelName::onlyTrashed()->count();
                }
                if (strlen($searchContent)) {
                    $Plural_Model__Name = ModelName::onlyTrashed()
                        ->where(function ($query) use ($searchContent) {
                            return $query->where('name_ar', 'like', '%' . $searchContent . '%')
                                ->orWhere('name_en', 'like', '%' . $searchContent . '%');
                        })->paginate($length);
                } else {
                    $Plural_Model__Name = ModelName::onlyTrashed()->paginate($length);
                }
            }

            return view('dashboard-views.model_Name.pagination_data', compact('Plural_Model__Name', 'pageType'))->render();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard-views.model_Name.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateModelNameRequest $request)
    {
        $newStoredModelName = ModelName::create(
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

        return redirect()->route('model_Name.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ModelName $model_Name
     * @return \Illuminate\Http\Response
     */
    public function show(ModelName $model_Name)
    {
        return json_decode(collect([
            'ModelName' => json_decode($model_Name),
        ]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ModelName $model_Name
     * @return \Illuminate\Http\Response
     */
    public function edit(ModelName $model_Name)
    {
        return view('dashboard-views.model_Name.edit', compact('model_Name'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ModelName $model_Name
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateModelNameRequest $request, ModelName $model_Name)
    {
        $updatedModelName = $model_Name->update(
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

        return redirect()->route('model_Name.index');
    }

    /**
     * Trash the specified resource from storage.
     *
     * @param  \App\Models\Request $request
     * @return \Illuminate\Http\Response
     */
    public function trash(Request $request)
    {
        $model_Name = ModelName::findOrFail($request->model_Name_id);

        // Start Check if record can be deleted
        $availableToDelete = true;
        $errorMessage = '';
        $status = null;

        // Start transaction
        DB::beginTransaction();
        try {
            $model_Name->forceDelete();
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
        $model_Name = ModelName::findOrFail($request->model_Name_id);
        if ($availableToDelete) {
            $status = true;
            $model_Name->delete();
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
        $model_Name = ModelName::withTrashed()->where('id', $request->model_Name_id)->firstOrFail();
        $status = null;

        if ($model_Name->trashed()) {
            $model_Name->restore();

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

            $model_Name = ModelName::onlyTrashed()->findOrFail($request->model_Name_id);

            $deletedModelName = clone $model_Name; // used in notifications

            $model_Name->forceDelete();

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
