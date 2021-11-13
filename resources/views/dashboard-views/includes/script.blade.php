<!-- REQUIRED SCRIPTS -->
{{-- Start first logic before optimization --}}

{{-- <!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }} "></script>

@if (app()->getLocale() == 'ar')
    <script src="{{ asset('dist/js-rtl/bootstrap-rtl.bundle.min.js') }}"></script>
@else
    <!-- Bootstrap 4 bundle -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
@endif

<!-- AdminLTE App -->
<script src=" {{ asset('dist/js/adminlte.min.js') }} "></script>

<!-- toastr -->
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
{!! Toastr::message() !!}

<!-- custom general -->
<script src=" {{ asset('dist/js/custom-general.js') }} "></script> --}}

{{-- End first logic before optimization --}}

{{-- Start second logic after optimization --}}

@if (app()->getLocale() == 'ar')
    <script src=" {{ asset('dist/js-rtl/main.js') }} "></script>
    {{-- note this file must be update if you do changes in custom general => (dist/js/custom-general.js) and use (https://javascript-minifier.com/) --}}
@else
    <script src=" {{ asset('dist/js/main.js') }} "></script>
    {{-- note this file must be update if you do changes in custom general => (dist/js/custom-general.js) and use (https://javascript-minifier.com/) --}}
@endif
{!! Toastr::message() !!}

{{-- End second logic after optimization --}}
