@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'family-name',
'child' => 'create',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Add') @lang('site.family_name')
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
                    <h1>@lang('site.Family_names')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('family-name.index') }}">
                                @lang('site.Family_names')</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('site.Add') @lang('site.family_name')</li>
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
                        {{-- Form to create sub group --}}
                        <form action="{{ route('family-name.store') }}" method="POST" id="createFamilyName">
                            @csrf
                            <div class="row">

                                {{-- arabic name --}}
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

                                {{-- english name --}}
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
                                {{-- Choose Group --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.the_group') </label>
                                        <select id='Group' name="group_id" class="form-control" style="width: 100%;">
                                        <option value=""></option>
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
                                {{-- Choose sub group --}}
                                <div class="col-md-6 col-12">
                                    <div class="form-group ">
                                        <label> @lang('site.Choose') @lang('site.the_sub_group') </label>
                                        <select id='subGroup' name="sub_group_id" class="form-control" style="width: 100%;">
                                            
                                        </select>
                                    </div>
                                    @error('sub_group_id')
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
        $('#subGroup').select2({
            placeholder: "@lang('site.Choose') @lang('site.the_sub_group')",
            allowClear: true,
        });
        /*  End defining select2  */
         /*  define select2  */
         $('#Group').select2({
            placeholder: "@lang('site.Choose') @lang('site.the_group')",
            allowClear: true,
        });
        /*  End defining select2  */

    $('#Group').on('change', function() {
    $('#subGroup').html('');
    var groupId = $(this).val();
    if (groupId) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '{{ route('job_code.fetch_related_job') }}',
            data: {
                groupId: groupId
            },
            success: function(data) {
                data = JSON.parse(data);
                if (data.status) {
                    data.subGroups.forEach(SubGroup => {
                        $('#subGroup').append(
                            `<option></option><option value="${SubGroup.id}">${SubGroup['name_'+urlLang]}</option>`
                        )
                    });
                } else {
                    console.log('Error occur');
                }
            }
        });
}
});

        /*  Start validation  */
        $(function() {
            $('#createFamilyName').validate({
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
                    sub_group_id: {
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
                    sub_group_id: {
                        required: " @lang('site.the_sub_group') @lang('site.is_required')",
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
