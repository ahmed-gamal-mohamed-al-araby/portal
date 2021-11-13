@php
$currentLanguage = app()->getLocale();
$name = 'name_' . $currentLanguage;
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'approval_requests_timeline',
// 'child' => 'requests_timeline',
])


{{-- Custom Title --}}
@section('title')
    @lang('site.Approval_cycles')
@endsection

{{-- Custom Styles --}}
@section('styles')
<style> 
    .dataTables_length {
        text-align:right;   
    }
</style>
<link rel="stylesheet" href="{{ asset('plugins/tablesorter/css/theme.materialize.min.css') }}">
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
                        <li class="breadcrumb-item active">@lang('site.timeline')</li>
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
                            <h5>@lang('site.timeline')</h5>
                        </div>
                        
                        <div class="card-body text-center">
                        {{-- Table length filter --}}
                            @include('dashboard-views.includes.pagination_data_filter')

                            {{-- Table content --}}
                            <div id="table-data" class="table-responsive">
                                @include('dashboard-views.approval.pagination_data', ['pageType' => 'index'])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection


{{-- Custom scripts --}}
@section('scripts')
    <script src="{{ asset('plugins/tablesorter/js/jquery.tablesorter.combined.js') }}"></script>

    <script>
        // Start defining languages
        let languages = [];

        languages['delete_country_title'] = "@lang('site.Delete') @lang('site.the_country')";
        languages['delete_country_body'] =
            "@lang('site.confirm') @lang('site.delete') @lang('site.the_country') " +
            "{{ $currentLanguage == 'ar' ? '؟' : '?' }}";
        languages['delete_country_url'] = "{{ route('country.trash') }}";
        languages['delete_country_action_btn_text'] = "@lang('site.Delete')";
        // End defining languages

        // Start include pagination script
        const fetchDataURL =
            "{{ route('approval.pagination.fetch_data') }}", // This valriable used in pagination_script
            pageType = 'index';

        @include('dashboard-views.includes.pagination_script')
        // End include pagination script

        // Start handle action modal
        $(document).ready(function() {
            // Start change modal data
            $('#confirm_modal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const countryId = button.data('country_id');
                const confirmModalType = button.data('type');

                // Change form action attribute
                $('#confirm_form').attr('action', languages[`${confirmModalType}_country_url`]);

                // Change modal title
                $('#modal-title').text(languages[`${confirmModalType}_country_title`]);

                // Change modal body
                $('#modal-body p').text(languages[`${confirmModalType}_country_body`]);

                // Change modal action button text
                $('#action-btn-text').text(languages[`${confirmModalType}_country_action_btn_text`]);

                // Set input with button data-country_id
                $('.modal #country_id').val(countryId);
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
                                    `a[data-country_id="${basicData.country_id}"]`
                                ).parents('tr').find('td').eq(1).text(),
                                "@lang('site.Success')"
                            );
                            // $(`[name="table_records_length"]`).trigger('change'); // To  fetch data
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

