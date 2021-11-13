<?php

use App\Http\Controllers\Approvals\ApprovalCycleController;
use App\Http\Controllers\Governorate\GovernorateController;
use App\Http\Controllers\Country\CountryController;
use App\Http\Controllers\Department\DepartmentController;
use App\Http\Controllers\Group\FamilyNameController;
use App\Http\Controllers\Group\GroupController;
use App\Http\Controllers\Group\SubGroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Job\JobCodeController;
use App\Http\Controllers\Job\JobGradeController;
use App\Http\Controllers\Job\JobNameController;
use App\Http\Controllers\Organization\OrganizationChartController;
use App\Http\Controllers\Project\ProjectController;
use App\Http\Controllers\PurchaseRequest\PurchaseRequestsController;
use App\Http\Controllers\Sector\SectorController;
use App\Http\Controllers\Project\SiteController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {

        // Authentication routes
        Auth::routes();

        // Protected routes (Authenticated users only)
        Route::group(
            [
                'middleware' => 'auth'
            ],
            function () {

                // Start Dashboard routes
                Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

                Route::get('/home', function () {
                    return redirect()->route('dashboard');
                })->name('home');

                Route::get('/', function () {
                    return redirect()->route('dashboard');
                });
                // Start Dashboard routes

                Route::get('organization/chart', OrganizationChartController::class)->name('organization.chart.index');

                // Sector
                Route::group([], function () {
                    Route::get('sector/trash', [SectorController::class, 'trash_index'])->name('sector.trash_index');
                    Route::get('sector/pagination/fetch_data', [SectorController::class, 'fetch_data'])->name('sector.pagination.fetch_data');
                    Route::post('sector/trash', [SectorController::class, 'trash'])->name('sector.trash');
                    Route::post('sector/restore', [SectorController::class, 'restore'])->name('sector.restore');
                    Route::post('sector/permanent-delete', [SectorController::class, 'permanent_delete'])->name('sector.permanent_delete');
                    Route::post('sector/fetch-related-sector', [SectorController::class, 'fetch_related_sector'])->name('sector.fetch_related_sector');
                    Route::resource('sector', SectorController::class)->except('destroy');
                });

                // Department
                Route::group([], function () {
                    Route::get('department/trash', [DepartmentController::class, 'trash_index'])->name('department.trash_index');
                    Route::get('department/pagination/fetch_data', [DepartmentController::class, 'fetch_data'])->name('department.pagination.fetch_data');
                    Route::post('department/trash', [DepartmentController::class, 'trash'])->name('department.trash');
                    Route::post('department/_trash', [DepartmentController::class, '_trash'])->name('department._trash');
                    Route::post('department/restore', [DepartmentController::class, 'restore'])->name('department.restore');
                    Route::post('department/_restore', [DepartmentController::class, '_restore'])->name('department._restore');
                    Route::post('department/permanent-delete', [DepartmentController::class, 'permanent_delete'])->name('department.permanent_delete');
                    Route::post('department/_permanent-delete', [DepartmentController::class, '_permanent_delete'])->name('department._permanent_delete');
                    Route::resource('department', DepartmentController::class)->except('destroy');
                });

                // Project
                Route::group([], function () {
                    Route::get('project/completed', [ProjectController::class, 'completed_index'])->name('project.completed_index');
                    Route::get('project/trash', [ProjectController::class, 'trash_index'])->name('project.trash_index');
                    Route::get('project/pagination/fetch_data', [ProjectController::class, 'fetch_data'])->name('project.pagination.fetch_data');
                    Route::post('project/trash', [ProjectController::class, 'trash'])->name('project.trash');
                    Route::post('project/restore', [ProjectController::class, 'restore'])->name('project.restore');
                    Route::post('project/permanent-delete', [ProjectController::class, 'permanent_delete'])->name('project.permanent_delete');
                    Route::post('project/fetch-related-site', [ProjectController::class, 'fetch_related_site'])->name('project.fetch_related_site');
                    Route::resource('project', ProjectController::class)->except('destroy');
                });

                // Site
                Route::group([], function () {
                    Route::get('site/completed', [SiteController::class, 'completed_index'])->name('site.completed_index');
                    Route::get('site/trash', [SiteController::class, 'trash_index'])->name('site.trash_index');
                    Route::get('site/pagination/fetch_data', [SiteController::class, 'fetch_data'])->name('site.pagination.fetch_data');
                    Route::post('site/trash', [SiteController::class, 'trash'])->name('site.trash');
                    Route::post('site/restore', [SiteController::class, 'restore'])->name('site.restore');
                    Route::post('site/permanent-delete', [SiteController::class, 'permanent_delete'])->name('site.permanent_delete');
                    Route::resource('site', SiteController::class)->except('destroy');
                });

                // Employee
                Route::group([], function () {
                    Route::get('employee/deactive', [UserController::class, 'trash_index'])->name('employee.deactive_index');
                    Route::get('employee/pagination/fetch_data', [UserController::class, 'fetch_data'])->name('employee.pagination.fetch_data');
                    Route::post('employee/deactive', [UserController::class, 'trash'])->name('employee.deactive');
                    Route::get('employee/deactive/trash/{id}', [UserController::class, 'trashpost'])->name('employee.deactive.trash');
                    Route::get('employee/deactive/all/{id}', [UserController::class, 'trashAll'])->name('employee.deactive.all');
                    Route::get('employee/restore/{id}', [UserController::class, 'restore'])->name('employee.restore.employee');
                    Route::post('employee/active', [UserController::class, 'active'])->name('employee.restore');
                    Route::resource('employee', UserController::class)->except('destroy');
                });

                // Job Code
                Route::group([], function () {
                    Route::get('job-code/trash', [JobCodeController::class, 'trash_index'])->name('job_code.trash_index');
                    Route::get('job-code/pagination/fetch_data', [JobCodeController::class, 'fetch_data'])->name('job_code.pagination.fetch_data');
                    Route::post('job-code/trash', [JobCodeController::class, 'trash'])->name('job_code.trash');
                    Route::post('job-code/restore', [JobCodeController::class, 'restore'])->name('job_code.restore');
                    Route::post('job-code/permanent-delete', [JobCodeController::class, 'permanent_delete'])->name('job_code.permanent_delete');
                    Route::post('job-code/fetch-related-job-code', [JobCodeController::class, 'fetch_related_job_code'])->name('job_code.fetch_related_job_code');
                    Route::resource('job-code', JobCodeController::class)->except('destroy');
                });

                // Job Grade
                Route::group([], function () {
                    Route::get('job-grade/trash', [JobGradeController::class, 'trash_index'])->name('job_grade.trash_index');
                    Route::get('job-grade/pagination/fetch_data', [JobGradeController::class, 'fetch_data'])->name('job_grade.pagination.fetch_data');
                    Route::post('job-grade/trash', [JobGradeController::class, 'trash'])->name('job_grade.trash');
                    Route::post('job-grade/restore', [JobGradeController::class, 'restore'])->name('job_grade.restore');
                    Route::post('job-grade/permanent-delete', [JobGradeController::class, 'permanent_delete'])->name('job_grade.permanent_delete');
                    Route::resource('job-grade', JobGradeController::class)->except('destroy');
                });

                // Job Name
                Route::group([], function () {
                    Route::get('job-name/trash', [JobNameController::class, 'trash_index'])->name('job_name.trash_index');
                    Route::get('job-name/pagination/fetch_data', [JobNameController::class, 'fetch_data'])->name('job_name.pagination.fetch_data');
                    Route::post('job-name/trash', [JobNameController::class, 'trash'])->name('job_name.trash');
                    Route::post('job-name/restore', [JobNameController::class, 'restore'])->name('job_name.restore');
                    Route::post('job-name/permanent-delete', [JobNameController::class, 'permanent_delete'])->name('job_name.permanent_delete');
                    Route::resource('job-name', JobNameController::class)->except('destroy');
                });

                // Country
                Route::group([], function () {
                    Route::get('country/trash', [CountryController::class, 'trash_index'])->name('country.trash_index');
                    Route::get('country/pagination/fetch_data', [CountryController::class, 'fetch_data'])->name('country.pagination.fetch_data');
                    Route::post('country/trash', [CountryController::class, 'trash'])->name('country.trash');
                    Route::post('country/restore', [CountryController::class, 'restore'])->name('country.restore');
                    Route::post('country/permanent-delete', [CountryController::class, 'permanent_delete'])->name('country.permanent_delete');
                    Route::post('country/fetch-related-governorate', [CountryController::class, 'fetch_related_governorate'])->name('country.fetch_related_governorate');
                    Route::resource('country', CountryController::class)->except(['show', 'destroy']);
                });

                // Governorate
                Route::group([], function () {
                    Route::get('governorate/trash', [GovernorateController::class, 'trash_index'])->name('governorate.trash_index');
                    Route::get('governorate/pagination/fetch_data', [GovernorateController::class, 'fetch_data'])->name('governorate.pagination.fetch_data');
                    Route::post('governorate/trash', [GovernorateController::class, 'trash'])->name('governorate.trash');
                    Route::post('governorate/restore', [GovernorateController::class, 'restore'])->name('governorate.restore');
                    Route::post('governorate/permanent-delete', [GovernorateController::class, 'permanent_delete'])->name('governorate.permanent_delete');
                    Route::resource('governorate', GovernorateController::class)->except('destroy');
                });

                // -- Start purchase order system -- //
                Route::group(['middleware' => [],], function () {
                    // Group
                    Route::group([], function () {
                        Route::get('group/trash', [GroupController::class, 'trash_index'])->name('group.trash_index');
                        Route::get('group/pagination/fetch_data', [GroupController::class, 'fetch_data'])->name('group.pagination.fetch_data');
                        Route::post('group/trash', [GroupController::class, 'trash'])->name('group.trash');
                        Route::post('group/restore', [GroupController::class, 'restore'])->name('group.restore');
                        Route::post('group/permanent-delete', [GroupController::class, 'permanent_delete'])->name('group.permanent_delete');
                        Route::post('group/fetch-related-sub-group', [GroupController::class, 'fetch_related_sub_group'])->name('group.fetch_related_sub_group');
                        Route::resource('group', GroupController::class)->except('destroy');
                    });

                    // Sub group
                    Route::group([], function () {
                        Route::get('sub-group/trash', [SubGroupController::class, 'trash_index'])->name('sub_group.trash_index');
                        Route::get('sub-group/pagination/fetch_data', [SubGroupController::class, 'fetch_data'])->name('sub_group.pagination.fetch_data');
                        Route::post('sub-group/trash', [SubGroupController::class, 'trash'])->name('sub_group.trash');
                        Route::post('sub-group/restore', [SubGroupController::class, 'restore'])->name('sub_group.restore');
                        Route::post('sub-group/permanent-delete', [SubGroupController::class, 'permanent_delete'])->name('sub_group.permanent_delete');
                        Route::post('sub-group/fetch-related-family-name', [SubGroupController::class, 'fetch_related_family_name'])->name('sub_group.fetch_related_family_name');
                        Route::resource('sub-group', SubGroupController::class)->except('destroy');
                    });

                    // Family name
                    Route::group([], function () {
                        Route::get('family-name/trash', [FamilyNameController::class, 'trash_index'])->name('family_name.trash_index');
                        Route::get('family-name/pagination/fetch_data', [FamilyNameController::class, 'fetch_data'])->name('family_name.pagination.fetch_data');
                        Route::post('family-name/trash', [FamilyNameController::class, 'trash'])->name('family_name.trash');
                        Route::post('family-name/restore', [FamilyNameController::class, 'restore'])->name('family_name.restore');
                        Route::post('family-name/permanent-delete', [FamilyNameController::class, 'permanent_delete'])->name('family_name.permanent_delete');
                        Route::post('family-name/fetch-related-job', [FamilyNameController::class, 'fetch_related_job'])->name('job_code.fetch_related_job');
                        Route::resource('family-name', FamilyNameController::class)->except('destroy');
                    });

                    // Supplier
                    Route::group([], function () {
                        Route::get('supplier/trash', [SupplierController::class, 'trash_index'])->name('supplier.trash_index');
                        Route::get('supplier/pagination/fetch_data', [SupplierController::class, 'fetch_data'])->name('supplier.pagination.fetch_data');
                        Route::post('supplier/permanent-delete', [SupplierController::class, 'permanent_delete'])->name('supplier.permanent_delete');
                        Route::post('supplier/trash', [SupplierController::class, 'trash'])->name('supplier.trash');
                        Route::post('supplier/restore', [SupplierController::class, 'restore'])->name('supplier.restore');
                        Route::post('supplier-search', [SupplierController::class, 'supplier_search'])->name('supplier.supplier_search');
                        Route::get('supplier/search', [SupplierController::class, 'search'])->name('supplier.search');
                        Route::get('supplier/search/fetch', [SupplierController::class, 'search_fetch'])->name('supplier.fetch_data');
                        Route::resource('supplier', SupplierController::class)->except('destroy');
                    });

                    // Purchase request
                    Route::group([], function () {
                        Route::post('purchase-request/send-for-approve', [PurchaseRequestsController::class, 'sendForApproveSavedPR'])->name('purchase_request.send_for_approve');
                        Route::get('purchase-request/trash', [PurchaseRequestsController::class, 'trash_index'])->name('purchase_request.trash_index');
                        Route::get('purchase-request/pagination/fetch_data', [PurchaseRequestsController::class, 'fetch_data'])->name('purchase_request.pagination.fetch_data');
                        Route::post('purchase-request/trash', [PurchaseRequestsController::class, 'trash'])->name('purchase_request.trash');
                        Route::post('purchase-request/restore', [PurchaseRequestsController::class, 'restore'])->name('purchase_request.restore');
                        Route::post('purchase-request/permanent-delete', [PurchaseRequestsController::class, 'permanent_delete'])->name('purchase_request.permanent_delete');

                        Route::resource('purchase-request', PurchaseRequestsController::class)->except('destroy');
                    });
                });
                // -- End purchase order system -- //

                // -- Start Approvals -- //
                Route::group([], function () {
                    Route::get('approvals/show-all-cycles', [ApprovalCycleController::class, 'showAllCycles'])->name('approvals.show_all_cycles');
                    Route::get('approvals/timeline/show-all-approval-requests-timeline', [ApprovalCycleController::class, 'showAllApprovalRequestsTimeline'])->name('approvals.show_all_approval_requests_timeline');
                    Route::get('approvals/timeline/{approvalTimeline}', [ApprovalCycleController::class, 'timelineById'])->name('approvals.timeline_by_id');
                    Route::get('approvals/timeline/{tableName}/{recordId}', [ApprovalCycleController::class, 'timeline'])->name('approvals.timeline');
                    Route::get('approvals/action/approve/{id}', [ApprovalCycleController::class, 'approve'])->name('approvals.action.approve');
                    Route::get('approvals/action/revert/revert/{id}', [ApprovalCycleController::class, 'revert'])->name('approvals.action.revert');
                    Route::get('approvals/action/reject/{id}', [ApprovalCycleController::class, 'reject'])->name('approvals.action.reject');
                    Route::get('approvals/action/showOrder/{id}', [ApprovalCycleController::class, 'showOrder'])->name('approvals.action.showOrder');
                    
                    Route::get('approvals/pagination/fetch_data', [ApprovalCycleController::class, 'fetch_data'])->name('approval.pagination.fetch_data');

                    Route::resource('approvals', ApprovalCycleController::class)->only('index','show');
                });
                // -- End Approvals -- //
            }
        );
    }
);
