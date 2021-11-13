<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }} "></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }} "></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
@if (app()->getLocale() == 'ar')
    <script src="{{ asset('dist/js-rtl/bootstrap-rtl.bundle.min.js') }}"></script>
@else
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endif
{{-- <!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
{{--
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script> --}}
<!-- jQuery Knob Chart -->
{{-- <script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script> --}}
<!-- daterangepicker -->
{{-- <script src="{{ asset('plugins/moment/moment.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script> --}}
<!-- Tempusdominus Bootstrap 4 -->
{{-- <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script> --}}
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
{{-- <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script> --}}
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src=" {{ asset('dist/js/adminlte.js') }} "></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src=" {{ asset('dist/js/pages/dashboard.js') }} "></script> --}}
{{-- select 2 --}}
<script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src=" {{ asset('dist/js/demo.js') }} "></script>
{{-- toastr --}}
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
{!! Toastr::message() !!}

<script>
    const urlLang = window.location.href.includes('/ar/') ? 'ar' : 'en',
        subFolderURL = "{{ env('sub_Folder_URL', '') }}";
</script>

{{-- configure toastr options --}}
<script>
    toastr.options = {
        'closeButton': true,
        'progressBar': true,
        "positionClass": urlLang == 'en' ? "toast-top-right" : "toast-top-left",
        'timeOut': '10000',
        'extendedTimeOut': '10000',
    };
</script>

{{-- Serialize form as Associative array --}}
<script>
    $.fn.serializeAssoc = function() {
        var data = {};
        $.each(this.serializeArray(), function(key, obj) {
            var a = obj.name.match(/(.*?)\[(.*?)\]/);
            if (a !== null) {
                var subName = a[1];
                var subKey = a[2];

                if (!data[subName]) {
                    data[subName] = [];
                }

                if (!subKey.length) {
                    subKey = data[subName].length;
                }

                if (data[subName][subKey]) {
                    if ($.isArray(data[subName][subKey])) {
                        data[subName][subKey].push(obj.value);
                    } else {
                        data[subName][subKey] = [];
                        data[subName][subKey].push(obj.value);
                    }
                } else {
                    data[subName][subKey] = obj.value;
                }
            } else {
                if (data[obj.name]) {
                    if ($.isArray(data[obj.name])) {
                        data[obj.name].push(obj.value);
                    } else {
                        data[obj.name] = [];
                        data[obj.name].push(obj.value);
                    }
                } else {
                    data[obj.name] = obj.value;
                }
            }
        });
        return data;
    };
</script>
<script>
    // $(function() {
    //     $("#datatableTemplate").DataTable({
    //         "responsive": true,
    //         "lengthChange": true,
    //         "autoWidth": false,
    //         order: [0,'asc'],
    //         "lengthMenu": [
    //             [5, 10, 25, 50, -1],
    //             [5, 10, 25, 50, "All"]
    //         ],
    //         columnDefs: [{
    //             targets: "hiddenCols",
    //             visible: false
    //         }],
    //         "language": {
    //             search: '<i class="fa fa-filter" aria-hidden="true"></i>',
    //             searchPlaceholder: ' @lang("site.Search")',
    //             "lengthMenu": "@lang('site.Show') _MENU_  @lang('site.Records')",
    //             "paginate": {
    //                 "previous": "@lang('site.Prev')",
    //                 "next": "@lang('site.Next')",

    //             },
    //             "info": "@lang('site.Show') _START_  @lang('site.From') _TOTAL_  @lang('site.Record')",

    //             buttons: {
    //                 colvis: ' @lang("site.show_data")',
    //                 'print': ' @lang("site.print")',
    //                 'copy': ' @lang("site.copy")',
    //                 'excel': '@lang("site.excel")'
    //             },
    //             "emptyTable": "@lang('site.no_data')",
    //             "infoEmpty": "@lang('site.Show') 0 @lang('site.From') 0 @lang('site.Record')",
    //             "infoFiltered": "( @lang('site.search_in') _MAX_  @lang('site.Records'))",
    //         }
    //     }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    // });
</script>
