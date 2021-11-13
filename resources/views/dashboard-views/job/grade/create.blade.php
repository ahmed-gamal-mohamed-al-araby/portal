@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'job-grade',
'child' => 'create',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Add') @lang('site.job_grade')
@endsection

{{-- Custom Styles --}}
@section('styles')
    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
@endsection

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>@lang('site.Job_grades')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('job-grade.index') }}">
                                @lang('site.Job_grades')</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('site.Add') @lang('site.job_grade')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content service-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="form-layout">
                        {{-- Form to create Job grade --}}
                        <form action="{{ route('job-grade.store') }}" method="POST" id="createJobGrade">
                            @csrf
                            <div class="row">

                                {{-- grade --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="Add Service ">@lang('site.Job_grade') </label>
                                        <input type="number" min="1" max="29" step="1" name="grade" value="{{ old('grade') }}" class="form-control"
                                            placeholder="@lang('site.Job_grade')">
                                    </div>
                                    @error('grade')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose job code --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.the_job_code') </label>
                                        <select id='jobCode' name="job_code_id" class="form-control"
                                            style="width: 100%;">
                                            <option> </option>
                                            @foreach ($jobCodes as $jobCode)
                                                <option value="{{ $jobCode->id }}"
                                                    {{ old('job_code_id') == $jobCode->id ? 'selected' : '' }}>
                                                    {{ $jobCode->code }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('job_code_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Submit button --}}
                                <div class="col-12">
                                    <input type="submit" class="btn btn-success" value="@lang('site.Submit')">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

{{-- Custom scripts --}}
@section('scripts')
    {{-- select 2 --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-validation/additional-methods.min.js') }}"></script>
    <script>
        /*  define select2  */
        $('#jobCode').select2({
            placeholder: "@lang('site.Choose') @lang('site.job_code')",
            allowClear: true,
        });
        /*  End defining select2  */

        /*  Start validation  */
        $(function() {
            $('#createJobGrade').validate({
                rules: {
                    grade: {
                        required: true,
                    },
                    job_code_id: {
                        required: true,
                    }
                },
                messages: {
                    grade: {
                        required: "@lang('site.Job_grade') @lang('site.is_required')",
                    },
                    job_code_id: {
                        required: " @lang('site.Job_code') @lang('site.is_required')",
                    },
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
        /*  End validation  */
    </script>
@endsection
