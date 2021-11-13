@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'employee',
'child' => 'edit',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Edit') @lang('site.the_employee')
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
                    <h1>@lang('site.Employees')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">
                                @lang('site.Employees')</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('site.Edit') @lang('site.employee')</li>
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
                        {{-- Form to edit employee --}}
                        <form action="{{ route('employee.update', $user->id) }}" method="POST" id="editEmployee">
                            @csrf
                            @method('put')
                            <div class="row">

                                {{-- Arabic name --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="Add Service ">@lang('site.arabic_name') </label>
                                        <input type="text" name="name_ar" value="{{ $user->name_ar }}"
                                            class="form-control" placeholder="@lang('site.arabic_name')">
                                    </div>
                                    @error('name_ar')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- English name --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="Add Service ">@lang('site.english_name') </label>
                                        <input type="text" name="name_en" value="{{ $user->name_en }}"
                                            class="form-control" placeholder="@lang('site.english_name')">
                                    </div>
                                    @error('name_en')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- username --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="Add Service ">@lang('site.Username') </label>
                                        <input type="text" name="username" value="{{ $user->username }}"
                                            class="form-control" placeholder="@lang('site.Username')">
                                    </div>
                                    @error('username')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- email --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="validationCustom02">@lang('site.Email')</label>
                                        <input id="email" type="email" placeholder="@lang('site.Email')"
                                            class="form-control " name="email" value="{{ $user->email }}"
                                            autocomplete="email">
                                    </div>
                                    @error('email')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Arabic position --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="Add Service ">@lang('site.arabic_position') </label>
                                        <input type="text" name="position_ar" value="{{ $user->position_ar }}"
                                            class="form-control" placeholder="@lang('site.arabic_position')">
                                    </div>
                                    @error('position_ar')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- English position --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="Add Service ">@lang('site.english_position') </label>
                                        <input type="text" name="position_en" value="{{ $user->position_en }}"
                                            class="form-control" placeholder="@lang('site.english_position')">
                                    </div>
                                    @error('position_en')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>
    
                                {{-- Code --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="Add Service ">@lang('site.Job_code') </label>
                                        <input type="text" name="code_" value="{{ $user->code }}" disabled
                                            class="form-control" placeholder="@lang('site.Job_code')">
                                    </div>
                                    @error('code')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose sector --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.sector') </label>
                                        <select id='sector' name="sector_id" class="form-control" style="width: 100%;">
                                            <option> </option>
                                            @foreach ($sectors as $sector)
                                                <option value="{{ $sector->id }}"
                                                    {{ $user->sector->id == $sector->id ? 'selected' : '' }}>
                                                    {{ $sector['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('sector_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose Department --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.department') </label>
                                        <select id='department' name="department_id" class="form-control"
                                            style="width: 100%;">
                                            <option> </option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}"
                                                    {{ $_user['department'] == $department->id ? 'selected' : '' }}>
                                                    {{ $department['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('department_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose Project --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.project') </label>
                                        <select id='project' name="project_id" class="form-control" style="width: 100%;">
                                            <option> </option>
                                            @foreach ($projects as $project)
                                                <option value="{{ $project->id }}"
                                                    {{ $_user['project'] == $project->id ? 'selected' : '' }}>
                                                    {{ $project['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('project_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose manager --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.manager') </label>
                                        <select id='manager' name="manager_id" class="form-control" style="width: 100%;">
                                            <option> </option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $_user['manager'] == $user->id ? 'selected' : '' }}>
                                                    {{ $user['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('manager_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose job code --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.Job_code') </label>
                                        <select id='job_code' class="form-control" name="code" style="width: 100%;">
                                            <option> </option>
                                            @foreach ($jobCodes as $jobCode)
                                                <option value="{{ $jobCode->id }}"
                                                    {{ $_user['jobCode'] == $jobCode->id ? 'selected' : '' }}>
                                                    {{ $jobCode['code'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('job_code_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose job name --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.Job_name') </label>
                                        <select id='job_name' name="job_name_id" class="form-control" style="width: 100%;">
                                            <option> </option>
                                            @foreach ($jobNames as $jobName)
                                                <option value="{{ $jobName->id }}"
                                                    {{ $jobNames[0]->id == $jobName->id ? 'selected' : '' }}>
                                                    {{ $jobName['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('job_name_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose job grade --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.Job_grade') </label>
                                        <select id='job_grade' name="job_grade_id" class="form-control"
                                            style="width: 100%;">
                                            @foreach ($jobGrades as $jobGrade)
                                                <option value="{{ $jobGrade->id }}"
                                                    {{ $jobGrades[0]->id == $jobGrade->id ? 'selected' : '' }}>
                                                    {{ $jobGrade->grade }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('job_grade_id')
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
        /*  Start defining select2  */
        $('#sector').select2({
            placeholder: "@lang('site.Choose') @lang('site.sector')",
            allowClear: true,
        });
        $('#department').select2({
            placeholder: "@lang('site.Choose') @lang('site.department')",
            allowClear: true,
        });
        $('#project').select2({
            placeholder: "@lang('site.Choose') @lang('site.project')",
            allowClear: true,
        });
        $('#manager').select2({
            placeholder: "@lang('site.Choose') @lang('site.manager')",
            allowClear: true,
        });
        $('#job_code').select2({
            placeholder: "@lang('site.Choose') @lang('site.job_code')",
            allowClear: true,
        });
        $('#job_name').select2({
            placeholder: "@lang('site.Choose') @lang('site.job_name')",
            allowClear: true,
        });
        $('#job_grade').select2({
            placeholder: "@lang('site.Choose') @lang('site.job_grade')",
            allowClear: true,
        });
        /*  End defining select2  */

        /*  Start validation  */

        $(function() {
            $('#editEmployee').validate({
                rules: {
                    name_ar: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    name_en: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    position_ar: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    position_en: {
                        required: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    username: {
                        required: true,
                    },
                    email: {
                        email: true,
                        required: true,
                    },
                    code: {
                        required: true,
                        integer: true,
                    }
                },
                messages: {
                    name_ar: {
                        required: " @lang('site.Name') @lang('site.is_required')",
                        minlength: "@lang('site.minlength_letters_number') 2",
                        maxlength: "@lang('site.maxlength_letters_number') 255",

                    },
                    name_en: {
                        required: " @lang('site.Name') @lang('site.is_required')",
                        minlength: "@lang('site.minlength_letters_number') 2",
                        maxlength: "@lang('site.maxlength_letters_number') 255",
                    },
                    position_ar: {
                        required: " @lang('site.arabic_position') @lang('site.is_required')",
                        minlength: "@lang('site.minlength_letters_number') 2",
                        maxlength: "@lang('site.maxlength_letters_number') 255",

                    },
                    position_en: {
                        required: " @lang('site.english_position') @lang('site.is_required')",
                        minlength: "@lang('site.minlength_letters_number') 2",
                        maxlength: "@lang('site.maxlength_letters_number') 255",
                    },
                    username: {
                        required: " @lang('site.Username') @lang('site.is_required')",
                    },
                    email: {
                        required: " @lang('site.Email') @lang('site.is_required')",
                        email: " @lang('site.Email') @lang('site.not_vaild')",
                    },
                    code: {
                        required: " @lang('site.Employee_code') @lang('site.is_required')",
                        integer: " @lang('site.Employee_code') @lang('site.not_integer')",
                    }
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
        /* get job names by choose job code */
        $('#job_code').on('change', function() {

    $('#job_name').html('');
    $('#job_grade').html('');
    var jobCodeId = $(this).val();
    if (jobCodeId) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route('job_code.fetch_related_job_code') }}',
            data: {
                jobCodeId: jobCodeId
            },
            success: function(data) {
                data = JSON.parse(data);

                if (data.status) {
                    data.jobGrades.forEach(jobGrade => {
                        $('#job_grade').append(
                            `<option></option><option value="${jobGrade.id}">${jobGrade.grade}</option>`
                        )
                    });

                    data.jobNames.forEach(jobName => {
                        $('#job_name').append(
                            `<option></option><option value="${jobName.id}">${jobName['name_'+urlLang]}</option>`
                        )
                    });
                } else {
                    console.log('Error occur');
                }
            }
        });
}
});
    </script>
@endsection
