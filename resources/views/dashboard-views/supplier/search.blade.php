@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'supplier',
'child' => 'index',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Suppliers')
@endsection

{{-- Custom Styles --}}
@section('styles')
    <link rel="stylesheet" href="{{ asset('plugins/tablesorter/css/theme.materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endsection

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>@lang('site.search.Suppliers')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item active">@lang('site.search.Suppliers')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content service-content">
        <div class="container-fluid">
            <div class="row">
              
            <div class="card-body">
                <form action="">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                            <select id='name' name="name" class="form-control" style="width: 100%;">
                            <option value="">@lang('site.search_by_name')</option>
                                @foreach($suppliers as $supplier)
                                 <option value="{{$supplier->id}}">{{$supplier['name_' . $currentLanguage]}}</option>
                                @endforeach
                        </select>
                    </div>

                           
                        </div>
                        {{-- 
                        <div class="col-md-3">
                        <div class="form-group">           
                        <select id='address' name="address" class="form-control" style="width: 100%;">
                        <option value="">@lang('site.search_by_address')</option>
                        @foreach($addresses as $address)
                                 <option value="{{$address->id}}">{{$address['city_' . $currentLanguage]}}</option>
                                @endforeach
                        </select>    
                            </div>
                        </div>
                           --}}
                        <div class="col-md-4">
                        <div class="form-group">
                        <select id='job' name="job" class="form-control" style="width: 100%;">
                        <option value="">@lang('site.search_by_job')</option>
                      
                                @foreach($family_names as $family_name)
                                        <option value="{{$family_name->id}}">
                                            {{$family_name['name_' . $currentLanguage]}}
                                            </option>
                                @endforeach
                          
                        </select>                               </div>
                        </div>
                        <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success my-1 mx-0 btn-sm">@lang("site.search")</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

           
            <!-- /.row -->
        </div>
        <div class="card">
                        <div class="card-body">

                
                            {{-- Table content --}}
                            <div id="table-data" class="table-responsive">
                            
                                @include('dashboard-views.supplier.dataSearch', ['pageType' => 'index'])
                           
                        </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
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

                    {{-- Form to Trash supplier --}}
                    <form action="" method="POST" id="confirm_form">
                        @csrf
                        <input type="hidden" name="supplier_id" id="supplier_id" value="">
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
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>

    <script>
        // Start defining languages
        let languages = [];

        languages['delete_supplier_title'] = "@lang('site.Delete') @lang('site.the_supplier')";
        languages['delete_supplier_body'] =
            "@lang('site.confirm') @lang('site.delete') @lang('site.the_supplier') " +
            "{{ $currentLanguage == 'ar' ? '؟' : '?' }}";
        languages['delete_supplier_url'] = "{{ route('supplier.trash') }}";
        languages['delete_supplier_action_btn_text'] = "@lang('site.Delete')";
        // End defining languages
 /*  Start defining select2  */
            $('#address').select2({
            placeholder: " @lang('site.search_by_address')",
            allowClear: true,
        });
        $('#name').select2({
            placeholder: " @lang('site.search_by_name')",
            allowClear: true,
        });
        $('#job').select2({
            placeholder: " @lang('site.search_by_job')",
            allowClear: true,
        });
        /*  End defining select2  */
        // Start include pagination script
        const fetchDataURL =
            "{{ route('supplier.pagination.fetch_data') }}", // This valriable used in pagination_script
            pageType = 'index';

        @include('dashboard-views.includes.pagination_script')
        // End include pagination script

        // Start handle action modal
        $(document).ready(function() {
            // Start change modal data
            $('#confirm_modal').on('show.bs.modal', function(event) {
                const button = $(event.relatedTarget);
                const supplierId = button.data('supplier_id');
                const confirmModalType = button.data('type');

                // Change form action attribute
                $('#confirm_form').attr('action', languages[`${confirmModalType}_supplier_url`]);

                // Change modal title
                $('#modal-title').text(languages[`${confirmModalType}_supplier_title`]);

                // Change modal body
                $('#modal-body p').text(languages[`${confirmModalType}_supplier_body`]);

                // Change modal action button text
                $('#action-btn-text').text(languages[`${confirmModalType}_supplier_action_btn_text`]);

                // Set input with button data-supplier_id
                $('.modal #supplier_id').val(supplierId);
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
                                    `a[data-supplier_id="${basicData.supplier_id}"]`
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

<script> 
      $(function () {

        $('form').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'get',
            url: '{{route("supplier.fetch_data")}}',
            data: $('form').serialize(),
            success: function (data) {
             $('#table-data').html(data);
            }
          });

        });

      });
   
</script>

@endsection
