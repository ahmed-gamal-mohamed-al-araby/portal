@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'project',
'child' => 'create',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Add') @lang('site.project')
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
                    <h1>@lang('site.Projects')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('project.index') }}">
                                @lang('site.Projects')</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('site.Add') @lang('site.project')</li>
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
                        {{-- Form to create project --}}
                        <form action="{{ route('project.store') }}" method="POST" id="createProject">
                            @csrf
                            <div class="row">

                                {{-- Arabic name --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label for="Add Service ">@lang('site.arabic_name') </label>
                                        <input type="text" name="name_ar" value="{{ old('name_ar') }}"
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
                                        <input type="text" name="name_en" value="{{ old('name_en') }}"
                                            class="form-control" placeholder="@lang('site.english_name')">
                                    </div>
                                    @error('name_en')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Arabic description --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>@lang('site.arabic_description')</label>
                                        <textarea class="form-control" name="description_ar" rows="3"
                                            placeholder="@lang('site.arabic_description')"></textarea>
                                    </div>
                                    @error('description_ar')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- English description --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label>@lang('site.english_description')</label>
                                        <textarea class="form-control" name="description_en" rows="3"
                                            placeholder="@lang('site.english_description')"></textarea>
                                    </div>
                                    @error('description_en')
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
                                                    {{ old('sector_id') == $sector->id ? 'selected' : '' }}>
                                                    {{ $sector['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('sector_id')
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
                                                    {{ old('manager_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('manager_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose delegated --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.manager_delegate') </label>
                                        <select id='delegated' name="delegated_id" class="form-control"
                                            style="width: 100%;">
                                            <option> </option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ old('delegated_id') == $user->id ? 'selected' : '' }}>
                                                    {{ $user['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('delegated_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose group --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.manager_delegate') </label>
                                        <select id='group' name="group_id" class="form-control"
                                            style="width: 100%;">
                                            <option> </option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}"
                                                    {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                                    {{ $group['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('group_id')
                                        <p class="text-bold text-danger mt-n3 font-n8rem">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Choose project complete status --}}
                                <div class="col-md-6 col-12 mt-md-4 pt-md-2 mb-2">
                                    <div class="form-group mb-0">
                                        <div
                                            class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input type="checkbox" class="custom-control-input" id="project-completed">
                                            <input type="hidden" name="completed" value="0">
                                            <label class="custom-control-label noselect"
                                                for="project-completed">@lang('site.project_completed_status')</label>
                                        </div>
                                    </div>
                                    @error('completed')
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
    <script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>

    <script>
        /*  define select2  */
        $('#sector').select2({
            placeholder: "@lang('site.Choose') @lang('site.sector')",
            allowClear: true,
        });
        $('#manager').select2({
            placeholder: "@lang('site.Choose') @lang('site.manager')",
            allowClear: true,
        });
        $('#delegated').select2({
            placeholder: "@lang('site.Choose') @lang('site.manager_delegate')",
            allowClear: true,
        });
        /*  End defining select2  */

        /*  Start validation  */
        $(function() {
            $.validator.setDefaults({
                ignore: []
            });
            $('#createProject').validate({
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
                    description_ar: {
                        required: true,
                    },
                    description_en: {
                        required: true,
                    },
                    sector_id: {
                        required: true,
                    },
                    manager_id: {
                        required: true,
                    },
                    delegated_id: {
                        required: true,
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
                    description_ar: {
                        required: " @lang('site.Description') @lang('site.is_required')",
                    },
                    description_en: {
                        required: " @lang('site.Description') @lang('site.is_required')",
                    },
                    sector_id: {
                        required: " @lang('site.the_sector') @lang('site.is_required')",
                    },
                    manager_id: {
                        required: " @lang('site.the_manager') @lang('site.is_required')",
                    },
                    delegated_id: {
                        required: " @lang('site.the_manager_delegate') @lang('site.is_required')",
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

            $('#manager').on('change', function() {
                $('#delegated').find('option').prop('disabled', false);
                $('#delegated').find(`option[value="${$(this).val()}"]`).prop('disabled', true);
            })

            $('#delegated').on('change', function() {
                $('#manager').find('option').prop('disabled', false);
                $('#manager').find(`option[value="${$(this).val()}"]`).prop('disabled', true);
            })
        });
        /*  End validation  */

        /* Start text editor */
        ClassicEditor.create(document.querySelector('[name="description_ar"]')).
        catch(error => {
            console.log(error);
        })

        ClassicEditor.create(document.querySelector('[name="description_en"]')).
        catch(error => {
            console.log(error);
        })
        /* End text editor */
    </script>
@endsection
