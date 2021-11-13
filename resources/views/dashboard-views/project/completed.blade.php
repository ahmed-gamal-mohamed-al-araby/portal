@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'project',
'child' => 'completed',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Completed_projects')
@endsection

{{-- Custom Styles --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/tablesorter/css/theme.materialize.min.css') }}">
@endsection

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>@lang('site.Completed_projects')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item active"> @lang('site.Completed_projects')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content service-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row mb-3 justify-content-between">
                        <div class="col-4">
                            <a href="{{ route('project.create') }}" class="btn btn-success header-btn ">@lang('site.Add')
                                @lang('site.project')</a>
                        </div>
                        <div class="col-8 d-flex justify-content-end">
                            <a href="{{ route('project.trash') }}"
                                class="btn btn-warning header-btn  mx-2">@lang('site.Trashed_projects')
                                <span class="main-span"><span>
                            </a>
                            <a href="{{ route('project.index') }}"
                                class="btn btn-warning header-btn ">@lang('site.Projects')
                                <span class="main-span"><span>
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">

                            {{-- Table length filter --}}
                            @include('dashboard-views.includes.pagination_data_filter')

                            {{-- Table content --}}
                            <div id="table-data" class="table-responsive">
                                @include('dashboard-views.project.pagination_data', ['pageType' => 'completed'])
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    {{-- Confirm modal --}}
    <div class="modal fade text-center" id="confirm_modal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                    <p></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-dark" data-dismiss="modal"> @lang('site.No') ,
                        @lang('site.Cancel')</button>

                    {{-- Form to Trash project --}}
                    <form action="" method="POST" id="confirm_form">
                        @csrf
                        <input type="hidden" name="project_id" id="project_id" value="">
                        <button type="submit" class="btn btn-outline-dark"> @lang('site.Yes') , <span
                                id="action-btn-text"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('plugins/tablesorter/js/jquery.tablesorter.combined.js') }}"></script>

    <script>
        // Start defining languages
        let languages = [];

        languages['delete_project_title'] = "@lang('site.Delete') @lang('site.the_project')";
        languages['delete_project_body'] =
            "@lang('site.confirm') @lang('site.delete') @lang('site.the_project') " +
            "{{ $currentLanguage == 'ar' ? '؟' : '?' }}";
        languages['delete_project_url'] = "{{ route('project.trash') }}";
        languages['delete_project_action_btn_text'] = "@lang('site.Delete')";
        // End defining languages

        // Start include pagination script
        const fetchDataURL =
            "{{ route('project.pagination.fetch_data') }}", // This valriable used in pagination_script
            pageType = 'completed';

        @include('dashboard-views.includes.pagination_script')
        // End include pagination script

        // Start handle action modal
        $(document).ready(function() {
            // Start change modal data
            $('#confirm_modal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const projectId = button.data('project_id');
                const confirmModalType = button.data('type');

                // Change form action attribute
                $('#confirm_form').attr('action', languages[`${confirmModalType}_project_url`]);

                // Change modal title
                $('#modal-title').text(languages[`${confirmModalType}_project_title`]);

                // Change modal body
                $('#modal-body p').text(languages[`${confirmModalType}_project_body`]);

                // Change modal action button text
                $('#action-btn-text').text(languages[`${confirmModalType}_project_action_btn_text`]);

                // Set input with button data-project_id
                $('.modal #project_id').val(projectId);
            });
            // End change modal data


            $('#confirm_form').on('submit', function(e) {
                e.preventDefault();
                const basicData = $('#confirm_form').serializeAssoc();

                delete basicData._token;
                $('.loader-container').fadeIn();
                $.ajax({
                    url: $(this).attr('action'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'post',
                    data: JSON.stringify(basicData),
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    success: function(response) {
                        // Start toastr notification
                        if (response.status == 1) {
                            toastr.warning(
                                "@lang('site.trash_successfully')" + "<br>" + $(
                                    `table tr:first`).find('th').eq(1).text() + ': ' +
                                $(
                                    `a[data-project_id="${basicData.project_id}"]`
                                ).parents('tr').find('td').eq(1).text(),
                                "@lang('site.Success')"
                            );
                            $(`[name="table_records_length"]`).trigger('change'); // To  fetch data
                        } else {
                            toastr.error(
                                response.errorMessage,
                                "@lang('site.Sorry')"
                            );
                        }
                        // End toastr notification
                    },
                    complete: function() {
                        $('#confirm_modal').modal('hide');
                        $('.loader-container').fadeOut();
                    }
                });
            });
        });
        // End handle action modal

        // Sort table
        $.extend($.tablesorter.defaults, {
            theme: 'materialize',
        });
        $(".sort-table").tablesorter();
    </script>
@endsection
