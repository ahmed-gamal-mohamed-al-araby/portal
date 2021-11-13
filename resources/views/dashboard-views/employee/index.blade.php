@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'employee',
'child' => 'index',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Employees')
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
                    <h1>@lang('site.Employees')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item active"> @lang('site.Employees')</li>
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
                    <div class="row mb-3">
                        <div class="col-12 d-flex justify-content-between">
                            <a href="{{ route('employee.create') }}"
                                class="btn btn-success header-btn ">@lang('site.Add') @lang('site.employee')</a>
                            <a href="{{ route('employee.deactive') }}"
                                class="btn btn-warning header-btn ">@lang('site.Deactived_users')
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
                                @include('dashboard-views.employee.pagination_data', ['pageType' => 'index'])
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

    
@endsection
@section('scripts')
    <script src="{{ asset('plugins/tablesorter/js/jquery.tablesorter.combined.js') }}"></script>

    <script>
        // Start defining languages
        let languages = [];

        languages['deactive_user_title'] = "@lang('site.Deactive_employee')";
        languages['deactive_user_body'] = "@lang('site.confirm') @lang('site.deactive_employee') " + "{{ $currentLanguage == 'ar' ? '؟' : '?' }}";
        languages['deactive_user_url'] = "{{ route('employee.deactive') }}";
        languages['deactive_user_action_btn_text'] = "@lang('site.Deactive')";
        // End defining languages

        // Start include pagination script
        const fetchDataURL =
            "{{ route('employee.pagination.fetch_data') }}", // This valriable used in pagination_script
            pageType = 'index';

        @include('dashboard-views.includes.pagination_script')
        // End include pagination script

        // Start handle action modal
        $(document).ready(function() {
            // Start change modal data
            $('#confirm_modal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const userId = button.data('user_id');
                const confirmModalType = button.data('type');

                // Change form action attribute
                $('#confirm_form').attr('action', languages[`${confirmModalType}_user_url`]);

                // Change modal title
                $('#modal-title').text(languages[`${confirmModalType}_user_title`]);

                // Change modal body
                $('#modal-body p').text(languages[`${confirmModalType}_user_body`]);

                // Change modal action button text
                $('#action-btn-text').text(languages[`${confirmModalType}_user_action_btn_text`]);

                // Set input with button data-user_id
                $('.modal #user_id').val(userId);
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
                            "@lang('site.deactive_successfully')" + "<br>" + $(
                                    `table tr:first`).find('th').eq(1).text() + ': ' +
                                $(
                                    `a[data-user_id="${basicData.user_id}"]`
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
