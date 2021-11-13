@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'supplier',
'child' => 'create',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Add') @lang('site.supplier')
@endsection

{{-- Custom Styles --}}
@section('styles')
    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/supplier-steps.css') }}">
@endsection

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>@lang('site.Suppliers')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">
                                @lang('site.Suppliers')</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('site.Add') @lang('site.supplier')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content form-i_request">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="card-header checkout">
                            {{-- Steps --}}
                            <div class="row justify-content-between m-0 align-items-center">
                                <div class="header-step col-md-6 col-12 p-0">
                                    <span class="step step1"> 1 </span>
                                    <span class="step step2"> 2 </span>
                                    <span class="step step3"> 3 </span>
                                    <span class="step step4"> 4 </span>
                                    <span class="step step5"> 5 </span>
                                </div>

                                <div class="col-md-6 col-12 p-0" id="card-header-text">

                                </div>
                            </div>
                        </div>
                        <main class="checkout">
                            <div class="card-data">
                                <div class="row no-gutters">
                                    <div class="col-12 ">
                                        <div class="card-body">
                                            <form action="{{ route('supplier.store') }}" method="post"
                                                enctype="multipart/form-data" id="createSupplier">
                                                @csrf
                                                {{-- Supplier Basic Data --}}
                                                <div class="tab">
                                                    <h1 class="tab-title d-none">@lang('site.supplier_data') </h1>
                                                    <div class="row">

                                                        {{-- arabic company Name --}}
                                                        <div class="col-md-6">
                                                            <div class="loader-inputcontainer mb-3">
                                                                <input type="text" name="name_ar"
                                                                    value="{{ old('name_ar') }}"
                                                                    class="form-control require company_name"
                                                                    placeholder="@lang('site.arabic_name')">
                                                                <div class="loader-icon-container">
                                                                    <i class="fas fa-spinner fa-spin"> </i>
                                                                </div>
                                                            </div>
                                                            @error('name_ar')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- english company Name --}}
                                                        <div class="col-md-6">
                                                            <div class="loader-inputcontainer mb-3">
                                                                <input type="text" name="name_en"
                                                                    value="{{ old('name_en') }}"
                                                                    class="form-control require company_name"
                                                                    placeholder="@lang('site.english_name')">
                                                                <div class="loader-icon-container">
                                                                    <i class="fas fa-spinner fa-spin"> </i>
                                                                </div>
                                                            </div>
                                                            @error('name_en')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Country --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <select id='country_id' name="country_id"
                                                                    class="form-control require">
                                                                    <option></option>
                                                                    @foreach ($countries as $country)
                                                                        <option value='{{ $country->id }}'
                                                                            {{ old('country_id') == $country->id ? 'selected' : '' }}>
                                                                            {{ ucfirst($country['name_' . $currentLanguage]) }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @error('country_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Governorate --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <select id='governorate_id' name="governorate_id"
                                                                    class="form-control require" disabled>
                                                                    <option disabled>@lang('site.governorate')
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            @error('governorate_id')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- arabic city --}}
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <input type="text" name="city_ar"
                                                                    value="{{ old('city_ar') }}"
                                                                    class="form-control require"
                                                                    placeholder="@lang('site.arabic_city')">
                                                            </div>
                                                            @error('city_ar')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- english city --}}
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <input type="text" name="city_en"
                                                                    value="{{ old('city_en') }}"
                                                                    class="form-control require"
                                                                    placeholder="@lang('site.english_city')">
                                                            </div>
                                                            @error('city_en')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- arabic street --}}
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <input type="text" name="street_ar"
                                                                    value="{{ old('street_ar') }}"
                                                                    class="form-control require"
                                                                    placeholder="@lang('site.arabic_street')">
                                                            </div>
                                                            @error('street_ar')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- english street --}}
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <input type="text" name="street_en"
                                                                    value="{{ old('street_en') }}"
                                                                    class="form-control require"
                                                                    placeholder="@lang('site.english_street')">
                                                            </div>
                                                            @error('street_en')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- building number --}}
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <input type="number" min="1" name="building_no"
                                                                    value="{{ old('building_no') }}"
                                                                    class="form-control require"
                                                                    placeholder="@lang('site.building_no')">
                                                            </div>
                                                            @error('building_no')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Email --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="email" name="email"
                                                                    value="{{ old('email') }}"
                                                                    class="form-control validate-email not-required"
                                                                    placeholder="@lang('site.Email')">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div class="text-danger d-none validate-email-error mb-3">
                                                                @lang('site.email_validation_error')
                                                            </div>

                                                            @error('email')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Phone --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" id="company_phone" name="phone"
                                                                    value="{{ old('phone') }}"
                                                                    class="form-control require validate-mobile"
                                                                    placeholder="@lang('site.Phone')">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div class="text-danger d-none validate-mobile-error mb-3">
                                                                @lang('site.mobile_validation_error')
                                                            </div>
                                                            @error('phone')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Mobile --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" id="company_mobile" name="mobile"
                                                                    value="{{ old('mobile') }}"
                                                                    class="form-control validate-mobile not-required"
                                                                    placeholder="@lang('site.Mobile')">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div class="text-danger d-none validate-mobile-error mb-3">
                                                                @lang('site.mobile_validation_error')
                                                            </div>
                                                            @error('mobile')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Fax --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="fax" value="{{ old('fax') }}"
                                                                    class="form-control not-required"
                                                                    placeholder="@lang('site.Fax') ">
                                                            </div>
                                                            @error('fax')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Google map URL --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="url" name="gmap_url"
                                                                    value="{{ old('gmap_url') }}"
                                                                    class="form-control validate-url not-required"
                                                                    placeholder="@lang('site.google_map_link')">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div class="text-danger d-none validate-url-error mb-3">
                                                                @lang('site.url_validation_error')
                                                            </div>

                                                            @error('gmap_url')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Website URL --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="url" name="website_url"
                                                                    value="{{ old('website_url') }}"
                                                                    class="form-control validate-url not-required"
                                                                    placeholder="@lang('site.Website_link') ">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div class="text-danger d-none validate-url-error mb-3">
                                                                @lang('site.url_validation_error')
                                                            </div>

                                                            @error('website_url')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Logo --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="file" name="logo" accept="image/*"
                                                                    class="custom-file-input w-auto ml-auto"
                                                                    id="logo_image_id">
                                                                <label
                                                                    class="custom-file-label text-overflow-dots rounded-0 m-0"
                                                                    style=" text-overflow: ellipsis; overflow: hidden; color: #999"
                                                                    for="logo_image_id">
                                                                    @lang('site.Choose')
                                                                    @lang('site.logo')
                                                                </label>
                                                            </div>
                                                            @error('logo')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                    </div>

                                                    {{-- Table content --}}
                                                    <div id="table-data" class="table-responsive d-none">
                                                    </div>

                                                </div>

                                                {{-- Responsible Person Data --}}
                                                <div class="tab">
                                                    <h1 class="tab-title d-none">@lang('site.person_data') </h1>

                                                    <div class="row">
                                                        <div class="col-12 select-preson">
                                                            @forelse (old('persons') ?? [] as $subGroupId => $responsibePerson)
                                                                <div class="row  @if (!$loop->first) person-row @endif"
                                                                    style=" background: #f4f6f9; border: 1px solid #DDD; padding: 10px 0 0 0; margin: 10px 0 15px 0;">

                                                                    {{-- name --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text"
                                                                                name="persons[{{ $loop->iteration - 1 }}][name]"
                                                                                value="{{ $responsibePerson['name'] }}"
                                                                                class="form-control require"
                                                                                placeholder="@lang('site.Name')">
                                                                        </div>
                                                                        @error("persons.$loop->index.name")
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Job --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text"
                                                                                name="persons[{{ $loop->iteration - 1 }}][job]"
                                                                                value="{{ $responsibePerson['job'] }}"
                                                                                class="form-control require"
                                                                                placeholder=" @lang('site.Job')">
                                                                        </div>
                                                                        @error("persons.$loop->index.job")
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Mobile --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text"
                                                                                name="persons[{{ $loop->iteration - 1 }}][mobile]"
                                                                                value="{{ $responsibePerson['mobile'] }}"
                                                                                class="form-control require validate-mobile"
                                                                                placeholder="@lang('site.Mobile')">
                                                                        </div>
                                                                        {{-- Validation --}}
                                                                        <div
                                                                            class="text-danger d-none validate-mobile-error mb-3">
                                                                            @lang('site.mobile_validation_error')
                                                                        </div>
                                                                        @error("persons.$loop->index.mobile")
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Whatapp --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text"
                                                                                name="persons[{{ $loop->iteration - 1 }}][whatsapp]"
                                                                                value="{{ $responsibePerson['whatsapp'] }}"
                                                                                class="form-control validate-mobile not-required"
                                                                                placeholder=" @lang('site.Whatsapp')">
                                                                        </div>
                                                                        {{-- Validation --}}
                                                                        <div
                                                                            class="text-danger d-none validate-mobile-error mb-3">
                                                                            @lang('site.mobile_validation_error')
                                                                        </div>
                                                                        @error("persons.$loop->index.whatsapp")
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Email --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="email"
                                                                                name="persons[{{ $loop->iteration - 1 }}][email]"
                                                                                value="{{ $responsibePerson['email'] }}"
                                                                                class="form-control validate-email not-required"
                                                                                placeholder="@lang('site.Email')">
                                                                        </div>
                                                                        {{-- Validation --}}
                                                                        <div
                                                                            class="text-danger d-none validate-email-error mb-3">
                                                                            @lang('site.email_validation_error')
                                                                        </div>
                                                                        @error("persons.$loop->index.email")
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Add new person --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            @if ($loop->first)
                                                                                <button type="button"
                                                                                    class="btn btn-success add-new-row ">@lang('site.add_person')</button>
                                                                            @else
                                                                                <button type="button"
                                                                                    class="btn btn-danger remove-person">
                                                                                    @lang('site.delete')</button>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    @error('persons')
                                                                        <div class="text-danger mx-3">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            @empty
                                                                <div class="row"
                                                                    style=" background: #f4f6f9; border: 1px solid #DDD; padding: 10px 0 0 0; margin: 10px 0 15px 0;">

                                                                    {{-- name --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="persons[0][name]"
                                                                                value="{{ old('persons[0][\'name\']') }}"
                                                                                class="form-control require"
                                                                                placeholder="@lang('site.Name')">
                                                                        </div>
                                                                        @error('persons.0.name')
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Job --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="persons[0][job]"
                                                                                value="{{ old('persons[0][\'job\']') }}"
                                                                                class="form-control require"
                                                                                placeholder=" @lang('site.Job')">
                                                                        </div>
                                                                        @error('persons.0.job')
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Mobile --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="persons[0][mobile]"
                                                                                value="{{ old('persons[0][\'mobile\']') }}"
                                                                                class="form-control require validate-mobile"
                                                                                placeholder="@lang('site.Mobile')">
                                                                        </div>
                                                                        {{-- Validation --}}
                                                                        <div
                                                                            class="text-danger d-none validate-mobile-error mb-3">
                                                                            @lang('site.mobile_validation_error')
                                                                        </div>
                                                                        @error('persons.0.mobile')
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Whatapp --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text" name="persons[0][whatsapp]"
                                                                                value="{{ old('persons[0][\'whatsapp\']') }}"
                                                                                class="form-control validate-mobile not-required"
                                                                                placeholder=" @lang('site.Whatsapp')">
                                                                        </div>
                                                                        {{-- Validation --}}
                                                                        <div
                                                                            class="text-danger d-none validate-mobile-error mb-3">
                                                                            @lang('site.mobile_validation_error')
                                                                        </div>
                                                                        @error('persons.0.whatsapp')
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Email --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <input type="email" name="persons[0][email]"
                                                                                value="{{ old('persons[0][\'email\']') }}"
                                                                                class="form-control validate-email not-required"
                                                                                placeholder="@lang('site.Email')">
                                                                        </div>
                                                                        {{-- Validation --}}
                                                                        <div
                                                                            class="text-danger d-none validate-email-error mb-3">
                                                                            @lang('site.email_validation_error')
                                                                        </div>
                                                                        @error('persons.0.email')
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Add new person --}}
                                                                    <div class="col-md-6">
                                                                        <div class="input-group mb-3">
                                                                            <button type="button"
                                                                                class="btn btn-success add-new-row ">@lang('site.add_person')</button>
                                                                        </div>
                                                                    </div>
                                                                    @error('persons')
                                                                        <div class="text-danger mx-3">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            @endforelse
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control" name="person_note"
                                                                    placeholder=" @lang('site.Note')">{{ old('person_note') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Supplier Family Names --}}
                                                <div class="tab">
                                                    <h1 class="tab-title d-none">@lang('site.supplier_family_names') </h1>

                                                    <div class="row">
                                                        <div class="col-12 family-name-container">
                                                            {{-- familyNames --}}
                                                            @forelse (old('subGroupsWithItsFamilyNames') ?? [] as $subGroupId => $subGroupWithItsFamilyNames)
                                                                <div class="row @if (!$loop->first) row-item @endif">

                                                                    {{-- SubGroup --}}
                                                                    <div class="col-md-5">
                                                                        <div class="input-group mb-3">
                                                                            <select name="subGroups[]"
                                                                                class="subGroup form-control require">
                                                                                <option></option>
                                                                                @foreach ($subGroups as $subGroup)
                                                                                    <option value='{{ $subGroup->id }}'
                                                                                        {{ $subGroup->id == $subGroupId ? 'selected' : '' }}>
                                                                                        {{ ucfirst($subGroup['name_' . $currentLanguage]) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error("subGroups.$loop->index")
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- FamilyName --}}
                                                                    <div class="col-md-5">
                                                                        <div class="input-group mb-3">
                                                                            <select name="familyNames[]"
                                                                                class="familyName_subGroup form-control  js-example-basic-multiple js-states0 required-multiple-select"
                                                                                multiple="multiple">
                                                                                @foreach ($subGroupWithItsFamilyNames['familyNames'] as $familyNames)
                                                                                    <option
                                                                                        value='{{ $familyNames['id'] }}'
                                                                                        {{ in_array($familyNames['id'], $subGroupWithItsFamilyNames['selectedFamilyNames']) ? 'selected' : '' }}>
                                                                                        {{ ucfirst($familyNames['name_' . $currentLanguage]) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error("familyNames.$loop->index")
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Add new family name --}}
                                                                    <div class="col-md-2 mb-3">
                                                                        @if ($loop->first)
                                                                            <button type="button"
                                                                                class="btn btn-success add-row">
                                                                                @lang('site.Add') </button>
                                                                        @else
                                                                            <button type="button"
                                                                                class="btn btn-danger remove-row">
                                                                                @lang('site.delete')</button>
                                                                        @endif
                                                                    </div>
                                                                    @error('subGroups')
                                                                        <div class="text-danger mx-3">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                    @error('familyNames')
                                                                        <div class="text-danger mx-3">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            @empty
                                                                <div class="row">

                                                                    {{-- SubGroup --}}
                                                                    <div class="col-md-5">
                                                                        <div class="input-group mb-3">
                                                                            <select name="subGroups[]"
                                                                                class="subGroup form-control require">
                                                                                <option></option>
                                                                                @foreach ($subGroups as $subGroup)
                                                                                    <option value='{{ $subGroup->id }}'>
                                                                                        {{ ucfirst($subGroup['name_' . $currentLanguage]) }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error('subGroups.0')
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- FamilyName --}}
                                                                    <div class="col-md-5">
                                                                        <div class="input-group mb-3">
                                                                            <select name="familyNames[]"
                                                                                class="familyName_subGroup form-control  js-example-basic-multiple js-states0 required-multiple-select"
                                                                                multiple="multiple">
                                                                            </select>
                                                                        </div>
                                                                        @error('familyNames.0')
                                                                            <div class="text-danger">{{ $message }}
                                                                            </div>
                                                                        @enderror
                                                                    </div>

                                                                    {{-- Add new family name --}}
                                                                    <div class="col-md-2 mb-3">
                                                                        <button type="button"
                                                                            class="btn btn-success add-row">
                                                                            @lang('site.Add') </button>
                                                                    </div>
                                                                    @error('subGroups')
                                                                        <div class="text-danger mx-3">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                    @error('familyNames')
                                                                        <div class="text-danger mx-3">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>
                                                            @endforelse
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control" name="family_name_note"
                                                                    placeholder="  @lang('site.Note')">{{ old('family_name_note') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Required file Supplier --}}
                                                <div class="tab">
                                                    <h1 class="tab-title d-none"> @lang('site.supplier_approval') </h1>
                                                    <div class="row supplier-accepted">

                                                        {{-- image --}}
                                                        {{-- <h6> @lang('site.add_image') <span> png , .jpg , .jpeg. </span>
                                                        </h6> --}}


                                                        {{-- tax id number input --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="tax_id_number"
                                                                    value="{{ old('tax_id_number') }}"
                                                                    class="form-control require validate-Tax-id-number-and-value-add-registeration-number"
                                                                    placeholder="@lang('site.Enter') @lang('site.tax_id_number')">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div
                                                                class="text-danger d-none validate-Tax-id-number-and-value-add-registeration-number-error mb-3">
                                                                @lang('site.validate_Tax_id_number_and_value_add_registeration_number_error')
                                                            </div>
                                                            @error('tax_id_number')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- tax id number file --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="file" name="tax_id_number_file"
                                                                    accept="application/pdf"
                                                                    class="custom-file-input w-auto ml-auto require"
                                                                    id="tax_id_number_file_id"
                                                                    oninput="this.className = 'custom-file-input w-auto ml-auto require'">
                                                                <label
                                                                    class="custom-file-label text-overflow-dots rounded-0 m-0"
                                                                    style="text-overflow: ellipsis; overflow: hidden; color: #999"
                                                                    for="tax_id_number_file_id">
                                                                    @lang('site.Choose')
                                                                    @lang('site.tax_id_number')
                                                                </label>
                                                            </div>
                                                            @error('tax_id_number_file')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <!-- ------------------------- -->

                                                        {{-- Commercial registeration number input --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="commercial_registeration_number"
                                                                    value="{{ old('commercial_registeration_number') }}"
                                                                    class="form-control require validate_commercial_registeration_number"
                                                                    placeholder="@lang('site.Enter') @lang('site.commercial_registeration_number')">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div
                                                                class="text-danger d-none validate-commercial-registeration-number-error mb-3">
                                                                @lang('site.validate_commercial_registeration_number_error')
                                                            </div>
                                                            @error('commercial_registeration_number')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Commercial registeration number file --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="file"
                                                                    name="commercial_registeration_number_file"
                                                                    accept="application/pdf"
                                                                    class="custom-file-input w-auto ml-auto require"
                                                                    id="commercial_registeration_number_file_id"
                                                                    oninput="this.className = 'custom-file-input w-auto ml-auto require'">
                                                                <label
                                                                    class="custom-file-label text-overflow-dots rounded-0 m-0"
                                                                    style=" text-overflow: ellipsis; overflow: hidden; color: #999"
                                                                    for="commercial_registeration_number_file_id">
                                                                    @lang('site.Choose')
                                                                    @lang('site.commercial_registeration_number')
                                                                </label>
                                                            </div>
                                                            @error('commercial_registeration_number_file')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <!-- ------------------------- -->

                                                        {{-- Value add registeration number input --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="value_add_registeration_number"
                                                                    value="{{ old('value_add_registeration_number') }}"
                                                                    class="form-control validate-Tax-id-number-and-value-add-registeration-number not-required"
                                                                    placeholder="@lang('site.Enter') @lang('site.value_add_registeration_number')">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div
                                                                class="text-danger d-none validate-Tax-id-number-and-value-add-registeration-number-error mb-3">
                                                                @lang('site.validate_Tax_id_number_and_value_add_registeration_number_error')
                                                            </div>
                                                            @error('value_add_registeration_number')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Value add registeration number file --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="file"
                                                                    name="value_add_registeration_number_file"
                                                                    accept="application/pdf"
                                                                    class="custom-file-input w-auto ml-auto not-required"
                                                                    id="value_add_registeration_number_file_id">
                                                                <label
                                                                    class="custom-file-label text-overflow-dots rounded-0 m-0"
                                                                    style=" text-overflow: ellipsis; overflow: hidden; color: #999"
                                                                    for="value_add_registeration_number_file_id">
                                                                    @lang('site.Choose')
                                                                    @lang('site.value_add_registeration_number')
                                                                </label>
                                                            </div>
                                                            @error('value_add_registeration_number_file')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <!-- ------------------------- -->

                                                              {{-- Value add tax number input --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="value_add_tax_number"
                                                                    value="{{ old('value_add_tax_number') }}"
                                                                    class="form-control validate-Tax-id-number-and-value-add-tax-number not-required"
                                                                    placeholder="@lang('site.Enter') @lang('site.value_add_tax_number')">
                                                            </div>
                                                            {{-- Validation --}}
                                                            <div
                                                                class="text-danger d-none validate-Tax-id-number-and-value-add-tax-number-error mb-3">
                                                                @lang('site.validate_Tax_id_number_and_value_add_tax_number_error')
                                                            </div>
                                                            @error('value_add_tax_number')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        {{-- tax file number file --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="file" name="tax_file_number_file"
                                                                    accept="application/pdf"
                                                                    class="custom-file-input w-auto ml-auto not-required"
                                                                    id="tax_file_number_file_file_id">
                                                                <label
                                                                    class="custom-file-label text-overflow-dots rounded-0 m-0"
                                                                    style=" text-overflow: ellipsis; overflow: hidden; color: #999"
                                                                    for="tax_file_number_file_file_id">
                                                                    @lang('site.Choose')
                                                                    @lang('site.tax_file_number')
                                                                </label>
                                                            </div>
                                                            @error('tax_file_number_file')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>


                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control" name="accredite_note"
                                                                    placeholder=" @lang('site.Note')">{{ old('accredite_note') }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- Supplier financial entity data --}}
                                                <div class="tab">
                                                    <h1 class="tab-title d-none"> @lang('site.payment_method') </h1>
                                                    <div class="row supplier-accepted">

                                                        {{-- Payment method --}}
                                                        <h5 class="col-12 mb-2" style="color:#6c757d!important">
                                                            @lang('site.check_available_payment_method')</h5>

                                                        {{-- Check box options for payment method --}}

                                                        <div class="col-12 row m-0 p-0">

                                                            <div class="col-12 row m-0">
                                                                {{-- Cashe option --}}
                                                                <div class="form-group mb-2 mx-30">
                                                                    <div
                                                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                            @if (old('cash') == '1')  value="1" {{ 'checked' }} @else value="0" @endif id="cash_check_id">
                                                                        <input type="hidden" name="cash"
                                                                            @if (old('cash') == '1')  value="1"  @else value="0" @endif>
                                                                        <label class="custom-control-label noselect"
                                                                            for="cash_check_id">@lang('site.cash')</label>
                                                                    </div>
                                                                </div>

                                                                {{-- Cashe cheque option --}}
                                                                <div class="form-group mb-2 mx-30">
                                                                    <div
                                                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                            id="cheque_check_id" @if (old('cheque') == '1')  value="1" {{ 'checked' }} @else value="0" @endif>
                                                                        <input type="hidden" name="cheque"
                                                                            @if (old('cheque') == '1')  value="1"  @else value="0" @endif>
                                                                        <label class="custom-control-label noselect"
                                                                            for="cheque_check_id">@lang('site.cheque')</label>
                                                                    </div>
                                                                </div>

                                                                {{-- Cashe bank_transfer option --}}
                                                                <div class="form-group mb-2 mx-30">
                                                                    <div
                                                                        class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                        <input type="checkbox" class="custom-control-input"
                                                                            id="bank_transfer_check_id"
                                                                            @if (old('bank_transfer') == '1')  value="1" {{ 'checked' }} @else value="0" @endif>
                                                                        <input type="hidden" name="bank_transfer"
                                                                            @if (old('bank_transfer') == '1')  value="1"  @else value="0" @endif>
                                                                        <label class="custom-control-label noselect"
                                                                            for="bank_transfer_check_id">@lang('site.bank_transfer')</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="text-danger d-none col-12 mb-2"
                                                                id="payment_option_error">
                                                                @lang('site.check_atleast_one_payment_method')</div>
                                                        </div>

                                                        {{-- Cheque --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <input type="text" name="name_on_cheque"
                                                                    value="{{ old('name_on_cheque') }}"
                                                                    class="form-control"
                                                                    placeholder="@lang('site.Enter') @lang('site.name_on_cheque')"
                                                                    {{ old('cheque') == '1' ? '' : 'disabled' }}>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-list-ol"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @error('name_on_cheque')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        <hr style="flex: 0 0 100%;">

                                                        {{-- Bank_transfer --}}
                                                        {{-- Bank account number --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="bank_account_number"
                                                                    value="{{ old('bank_account_number') }}"
                                                                    class="form-control"
                                                                    placeholder="@lang('site.Enter') @lang('site.bank_account_number')"
                                                                    {{ old('bank_transfer') == '1' ? '' : 'disabled' }}>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-list-ol"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @error('bank_account_number')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Bank name --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="bank_name" class="form-control"
                                                                    value="{{ old('bank_name') }}"
                                                                    placeholder="@lang('site.Enter') @lang('site.bank_name')"
                                                                    {{ old('bank_transfer') == '1' ? '' : 'disabled' }}>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-building"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @error('bank_name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                        {{-- Bank branch --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="text" name="bank_branch"
                                                                    class="form-control"
                                                                    value="{{ old('bank_branch') }}"
                                                                    placeholder="@lang('site.Enter') @lang('site.bank_branch')"
                                                                    {{ old('bank_transfer') == '1' ? '' : 'disabled' }}>
                                                                <div class="input-group-append">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-map-marker-alt"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            @error('bank_branch')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>


                                                <div style="overflow:auto;">
                                                    <div>
                                                        <button class="form-btn m-0" type="button" id="prevBtn"
                                                            onclick="nextPrev(-1, `@lang('site.Next')`, `@lang('site.Submit')`)">
                                                            @lang('site.Prev') </button>

                                                        <button class="form-btn m-0" type="button" id="nextBtn"
                                                            onclick="nextPrev(1, `@lang('site.Next')`, `@lang('site.Submit')`)">
                                                            @lang('site.Next') </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>


@endsection

{{-- Custom scripts --}}
@section('scripts')
    {{-- select 2 --}}
    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('dist/js/supplier-steps.js') }}"></script>
    <script>
        $(document).ready(function() {

            /*  define select2  */
            $('#country_id').select2({
                placeholder: "@lang('site.Choose') @lang('site.the_country')",
                allowClear: true,
            });
            $('#governorate_id').select2({
                placeholder: "@lang('site.Choose') @lang('site.the_governorate')",
                allowClear: true,
            });
            $('.subGroup').select2({
                placeholder: "@lang('site.Choose') @lang('site.sub_group')",
                allowClear: true,
            });
            $('.familyName_subGroup').select2({
                placeholder: "@lang('site.Choose') @lang('site.family_name')",
            });
            /*  End defining select2  */

            /* get cities by choose country */
            $('#country_id').on('change', function() {
                $('#governorate_id').html('');
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ route('country.fetch_related_governorate') }}',
                        data: {
                            countryId: countryId
                        },
                        success: function(data) {
                            data = JSON.parse(data);
                            if (data.status) {
                                $('#governorate_id').attr('disabled', false);
                                data.governorates.forEach(governorate => {
                                    $('#governorate_id').append(
                                        `<option></option><option value="${governorate.id}">${governorate['name_'+urlLang]}</option>`
                                    )
                                });
                            } else {
                                console.log('Error occur');
                            }
                            @if (old('governorate_id'))
                                $('#governorate_id').find(`option[value='{{ old('governorate_id') }}']`).attr('selected', true);
                            @endif
                        }
                    });
                }
            });

            /* get family names by choose sub groups */
            $(document).on('change', '.subGroup', function() {
                $(this).parent().parent().next().find('.familyName_subGroup').html('');
                var _that = $(this);
                var subGroupId = $(this).val();
                if (subGroupId) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ route('sub_group.fetch_related_family_name') }}',
                        data: {
                            subGroupId: subGroupId
                        },
                        success: function(data) {
                            data = JSON.parse(data);
                            _that.parent().parent().next().find('.familyName_subGroup').attr(
                                'disabled', false);
                            if (data.status) {
                                data.familyNames.forEach(familyName => {
                                    _that.parent().parent().next().find(
                                        '.familyName_subGroup').append(
                                        `<option></option><option value="${familyName.id}">${familyName['name_'+urlLang]}</option>`
                                    )
                                });
                            } else {
                                console.log('Error occur');
                            }
                            getAllUsedSubGroups();
                        }
                    });
                }
            });

            const fetchDataURL =
                "{{ route('supplier.supplier_search') }}";

            // Inform the data entry that some supplier contain part of your supplier name input
            $(document).on('keyup', '.company_name', function() {
                const that = $(this),
                    search_content_ar = $('[name="name_ar"]').val().length > 2 ? $(
                        '[name="name_ar"]')
                    .val() : '',
                    search_content_en = $('[name="name_en"]').val().length > 2 ? $('[name="name_en"]')
                    .val() : '';

                if (search_content_ar.length > 2 || search_content_en.length > 2) {
                    that.parent().find('.loader-icon-container').fadeIn();
                    $.ajax({
                        url: "{{ route('supplier.supplier_search') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'post',
                        data: JSON.stringify({
                            "search_content_ar": search_content_ar,
                            "search_content_en": search_content_en,
                        }),
                        contentType: 'application/json; charset=utf-8',
                        dataType: 'json',
                        success: function(data) {
                            if (data.length > 0)
                                $('#table-data').html(data.html).removeClass('d-none');
                            else
                                $('#table-data').html('').addClass('d-none');

                            that.parent().find('.loader-icon-container').fadeOut();
                        }
                    });

                } else {
                    $('#table-data').html('');
                }
            });

            showTab(currentTabIndex, `@lang('site.Next')`); // Display the current tab

            // FamilyName
            var i = 0;
            $('.family-name-container').on('click', '.add-row', function() {
                const new_family = $(`
                <div class="row row-item">

                    {{-- SubGroup --}}
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <select name="subGroups[]"
                                class="subGroup form-control require">
                                <option></option>
                                @foreach ($subGroups as $subGroup)
                                    <option value='{{ $subGroup->id }}'>
                                        {{ ucfirst($subGroup['name_' . $currentLanguage]) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- FamilyName --}}
                    <div class="col-md-5">
                        <div class="input-group mb-3">
                            <select name="familyNames[]"
                                class=" familyName_subGroup form-control  js-example-basic-multiple js-states required-multiple-select"
                                multiple="multiple">

                            </select>
                        </div>
                    </div>

                    {{-- Remove new family name --}}
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-row"> @lang('site.delete') </button>
                    </div>

                </div>
                `);

                $(".family-name-container").append(new_family);
                // $(selector).select2();


                new_family.find('.subGroup').select2({
                    placeholder: "@lang('site.Choose') @lang('site.sub_group')",
                    allowClear: true,
                });

                new_family.find('.familyName_subGroup').select2({
                    placeholder: "@lang('site.Choose') @lang('site.family_name')",
                    allowClear: true,
                });

                getAllUsedSubGroups();

                // // SubGroup
                // select2Function(new_family.find('.subGroup'),"@lang('site.capital_select') @lang('site.small_sub_group')",'supplier/getfamilyNamesFromSubCategory');
                // // familyName
                // select2Function(new_family.find('.familyName_subGroup'),"@lang('site.capital_select') @lang('site.small_family_name')");

            });

            $('.family-name-container').on('click', '.remove-row', function() {
                $(this).parents(".row-item").remove();
                getAllUsedSubGroups();
            });

            // person
            // Start from index 1 becouse the first form will start from index 0.
            var index = 1; // to add new person in array persons[${index}][name]
            $('.select-preson').on('click', '.add-new-row', function() {
                let new_person = $(this).parents('.row').eq(0).clone(true).addClass('person-row');

                // change attribute name to the index, and remove data
                new_person.find('div input').each(function(i, element) {
                    $(element).attr('name', $(element).attr('name').replace(/[d{0,}]/i, index)).val(
                        '');
                })
                // replace add button with remove button
                new_person.children().last().find('.input-group.mb-3').html(
                    '<button type="button" class="btn btn-danger remove-person"> @lang("site.delete") </button>'
                );
                new_person.find('[type=email]').removeClass("invalid is-invalid");
                new_person.find('.validate-email-error').addClass('d-none');

                $(".select-preson").append(new_person);
                index++;

            });

            $('.select-preson').on('click', '.remove-person', function() {
                $(this).parents(".person-row").remove();
            });

        });

        // Change input status [disable or enable]
        function changeInputStatus(selector, disabled, classList = '', addClass = true) {
            $(selector).prop('disabled', disabled).toggleClass(classList, addClass).val('');
        }

        $('#bank_transfer_check_id').change(function() {
            if (this.checked) {
                changeInputStatus("input[name='bank_name']", false, "require", true);
                changeInputStatus("input[name='bank_branch']", false, "require", true);
                changeInputStatus("input[name='bank_account_number']", false, "require", true);
            } else {
                changeInputStatus("input[name='bank_name']", true, "require invalid is-invalid", false);
                changeInputStatus("input[name='bank_branch']", true, "require invalid is-invalid", false);
                changeInputStatus("input[name='bank_account_number']", true, "require invalid is-invalid",
                    false);
            }
            validatePaymentMethod();
        });

        $('#cheque_check_id').change(function() {
            if (this.checked) {
                changeInputStatus("input[name='name_on_cheque']", false, "require", true);
            } else {
                changeInputStatus("input[name='name_on_cheque']", true, "require invalid is-invalid",
                    false);
            }
            validatePaymentMethod();
        });

        $('#cash_check_id').change(function() {
            validatePaymentMethod();
        });

        $('.checkout select.require').on('change', function() {
            $(this).removeClass('invalid');
        })

        // change label for input file
        $('input[type=file]').on('change', function() {
            $(this).next().text($(this).val());
        });

        subGroups = {!! json_encode($subGroups) !!};

        $(function() {
            // Set old data
            @if (old('country_id'))
                $('#country_id').trigger('change');
            @endif

            @if (old('subGroupsWithItsFamilyNames'))
                getAllUsedSubGroups()
            @endif
        });
    </script>
@endsection
