@php
$currentLanguage = app()->getLocale();
$name = 'name_' . $currentLanguage;
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'approval_index',
// 'child' => 'index',
])


{{-- Custom Title --}}
@section('title')
    @lang('site.Approval_cycles')
@endsection

{{-- Custom Styles --}}
@section('styles')

@endsection

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>@lang('site.Approval_cycles')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item active">@lang('site.Approval_cycles')</li>
                        <li class="breadcrumb-item active">@lang('site.Approval_requests')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content" style="position: relative">

        <div class="container-fluid ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header show-approval parent">
                            <h5>@lang('site.Approval_requests')</h5>
                        </div>
                        <div class="card-body text-center">
                            <table id="datatableTemplate" class="table table-bordered table-striped text-center sort-table">

                                {{-- Table Header --}}
                                <thead>
                                    <tr>
                                        <th> @lang('site.table_name')</th>
                                        {{-- <th> @lang('site.username')</th> --}}
                                        <th> @lang('site.StepLevel')</th>
                                        <th> @lang('site.stepName')</th>
                                        <th> @lang('site.approval_status')</th>
                                        <th> @lang('site.actions')</th>
                                    </tr>
                                </thead>

                                {{-- Table body --}}
                                <tbody>

                                    @foreach ($ApprovalTimelines as $ApprovalTimeline)
                                        <tr>
                                            <td>@lang('site.' . $ApprovalTimeline->table_name)</td>
                                            {{-- <td>{{ $ApprovalTimeline->username }}</td> --}}
                                            <td>{{ $ApprovalTimeline->level }}</td>
                                            <td>{{ $ApprovalTimeline->$name }}</td>
                                            <td>
                                                @if ($ApprovalTimeline->approval_status == 'P')
                                                    @lang('site.approval_status_pending')
                                                    <i class="fas fa-spinner fa-pulse text-warning"></i>
                                                @elseif($ApprovalTimeline->approval_status ==
                                                    'A')@lang('site.approval_status_approved')
                                                    <i class="fas fa-check text-success"></i>
                                                @elseif($ApprovalTimeline->approval_status ==
                                                    'RV')@lang('site.approval_status_reverted')
                                                    <i class="fas fa-undo-alt text-danger"></i>
                                                @elseif($ApprovalTimeline->approval_status ==
                                                    'RJ')@lang('site.approval_status_rejected')
                                                    <i class="fas fa-times text-danger"></i>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="service-option">
                                                <a href="{{ route('approvals.action.showOrder', $ApprovalTimeline->id) }}"
                                                        class="btn btn-success" tooltip="@lang('site.Show')"><i
                                                            class="fas fa-eye"></i></a>
                                                    <a href="{{ route('approvals.action.approve', $ApprovalTimeline->id) }}"
                                                        class="btn btn-success" tooltip="@lang('site.Approve')"><i
                                                            class="fas fa-paper-plane"></i></a>
                                                    <a href="{{ route('approvals.action.revert', $ApprovalTimeline->id) }}"
                                                        class="btn btn-warning" tooltip="@lang('site.Revert')"><i
                                                            class="fas fa-undo-alt"></i></a>
                                                    <a href="{{ route('approvals.action.reject', $ApprovalTimeline->id) }}"
                                                        class="btn btn-danger" tooltip="@lang('site.Reject')"><i
                                                            class="fa fa-times"></i></a>
                                                </div>
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection


{{-- Custom scripts --}}
@section('scripts')

@endsection
