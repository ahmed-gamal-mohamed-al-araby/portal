@php
$currentLanguage = app()->getLocale();
$name = 'name_' . $currentLanguage;
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'approval_show_all_cycles',
// 'child' => 'show_all_cycles',
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
                                        <th> @lang('site.Id')</th>
                                        <th> @lang('site.table_name')</th>
                                        <th> @lang('site.actions')</th>
                                    </tr>
                                </thead>

                                {{-- Table body --}}
                                <tbody>
                                    @foreach ($approvalCycles as $approvalCycle)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $approvalCycle['name_' . $currentLanguage] }}</td>
                                            <td>
                                                <div class="service-option">
                                                    <a href="{{ route('approvals.show', $approvalCycle->id) }}" class="btn btn-success"><i class="fa fa-eye"></i> @lang('site.Show') </a>
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
