@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'purchase-request',
'child' => 'create',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Add') @lang('site.purchase_request')
@endsection

{{-- Custom Styles --}}
@section('styles')
    {{-- select 2 --}}
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <style>
       
       
        .comment_reason {
            display: none;
        }

        .edit_reason {
            display: block;
        }
    
    </style>
@endsection

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>@lang('site.Purchase_requests')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('purchase-request.index') }}">
                                @lang('site.Purchase_requests')</a>
                        </li>
                        <li class="breadcrumb-item active"> @lang('site.Add') @lang('site.purchase_request')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content service-content purchase-request">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="form-layout mb-3">
                        <form action="{{ route('purchase-request.update', $purchaseRequest->id) }}" class="updatePurchaseRequest"
                            id="form" autocomplete="off" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('put')

                            <div class="row">
                                {{-- Date --}}
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                id="inputGroup-sizing-sm">@lang('site.Date')</span>
                                        </div>
                                        <input type="text" id="date" class="form-control" readonly>
                                        @if ($errors->has('date'))
                                            <em class="invalid-feedback">
                                                {{ $errors->first('date') }}
                                            </em>
                                        @endif
                                    </div>
                                </div>

                                {{-- Creator name --}}
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                id="inputGroup-sizing-sm">@lang('site.Creator')</span>
                                        </div>
                                        <input value="{{ auth()->user()['name_' . $currentLanguage] }}"
                                            class="form-control" readonly>
                                    </div>
                                </div>

                                {{-- Sector --}}
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                id="inputGroup-sizing-sm">@lang('site.Sector')</span>
                                        </div>
                                        <input value="{{ $userData['sector']['name_' . $currentLanguage] }}"
                                            class="form-control" readonly>
                                        <input type="hidden" name="sector_id" value="{{ $userData['sector']->id }}">
                                    </div>
                                </div>

                                @if ($userData['department'])
                                    {{-- Department --}}
                                    <div class="col-md-6">
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    id="inputGroup-sizing-sm">@lang('site.Department')</span>
                                            </div>
                                            <input value="{{ $userData['department']['name_' . $currentLanguage] }}"
                                                class="form-control" readonly>
                                            <input type="hidden" name="department_id"
                                                value="{{ $userData['department']->id }}">
                                        </div>
                                    </div>
                                @endif

                                @if (!$userData['department'])
                                    @if ($userData['project'])
                                        {{-- Project --}}
                                        <div class="col-md-6">
                                            <div class="input-group input-group-sm mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-sm">@lang('site.Project')</span>
                                                </div>
                                                <input value="{{ $userData['project']['name_' . $currentLanguage] }}"
                                                    class="form-control" readonly>
                                                <input type="hidden" name="project_id"
                                                    value="{{ $userData['project']->id }}">
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <div class="input-group input-group-sm mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"
                                                        id="inputGroup-sizing-sm">@lang('site.Projects')</span>
                                                </div>
                                                <select name="project_id" class="custom-select project" id="project">
                                                    <option></option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->id }}" data-toggle="tooltip"
                                                            data-placement="top" title="Group">
                                                            {{ $project['name_' . $currentLanguage] }}</option>
                                                    @endforeach
                                                </select>

                                                @if ($errors->has('project_id'))
                                                    <em class="invalid-feedback">
                                                        {{ $errors->first('project_id') }}
                                                    </em>
                                                @endif
                                            </div>
                                        </div>
                                    @endif

                                    {{-- site --}}
                                    <div class="col-md-6  site-section  @if (!$userData['project']) {{ 'd-none' }} @endif   ">
                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"
                                                    id="inputGroup-sizing-sm">@lang('site.Sites')</span>
                                            </div>
                                            <select name="site_id" class="custom-select" id="site" required
                                                @if (!$userData['project']) {{ 'disabled' }} @endif>
                                                @if ($userData['project'])
                                                    <option></option>
                                                    @foreach ($userData['project']['sites'] as $site)
                                                        <option value="{{ $site->id }}" @if ($site->id === $purchaseRequest->site_id) {{ 'selected' }} @endif>
                                                            {{ $site['name_' . $currentLanguage] }}</option>
                                                    @endforeach

                                                @endif
                                            </select>

                                            @if ($errors->has('site_id'))
                                                <em class="invalid-feedback">
                                                    {{ $errors->first('site_id') }}
                                                </em>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                {{-- Group --}}
                                <div class="col-md-6">
                                    <div class="input-group input-group-sm mb-2 ">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"
                                                id="inputGroup-sizing-sm">@lang('site.Group')</span>
                                        </div>
                                        <select name="group_id" class="custom-select group" id="group">
                                            <option></option>
                                            @foreach ($groups as $group)
                                                <option value="{{ $group->id }}" @if ($group->id === $purchaseRequest->group_id) {{ 'selected' }} @endif>
                                                    {{ $group['name_' . $currentLanguage] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- Items per purchase request --}}
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h5>@lang('site.the_items')</h5>
                                </div>

                                <div class="card-body">

                                    <div id="items_table" class="table">
                                        @forelse(old('family_names_id') ?? [] as $key => $purchaseRequestItems)
                                        <div id="item" class="tr">
                                            <div class="row">
                                                <div class="col-md-11">
                                                    <div class="form-row m-1 no-gutters">

                                                        {{-- subGroup --}}
                                                        <div class="col-12 col-md-6 col-lg-3 mb-1">
                                                            <select name=""
                                                                class="form-control SelectProduct getSubGroup "
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Sub Group">
                                                                <option value="" data-toggle="tooltip"
                                                                    data-placement="top" title="Sub Group">
                                                                </option>
                                                                @foreach (old('subGroups') as $subGroup)
                                                                    <option value='{{ $subGroup->id }}'
                                                                        {{ $subGroup->id == old('subGroupIds')[$key] ? 'selected' : '' }}>
                                                                        {{ ucfirst($subGroup['name_' . $currentLanguage]) }}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                            {{-- Validation --}}
                                                            <div
                                                                class="text-danger d-none required-validate-error mb-3">
                                                                @lang('site.data-required')
                                                            </div>

                                                        </div>

                                                        {{-- FamilyName --}}
                                                        <div class="col-12 col-md-6 col-lg-3 mb-1">
                                                            <select name="family_names_id[]"
                                                                class="form-control SelectItem Getitems"
                                                                data-toggle="tooltip" data-placement="top" title="Item">
                                                                <option value="" data-toggle="tooltip"
                                                                    data-placement="top" title="Item"></option>
                                                                    @foreach (old('familyNames')[$key] as $familyName)
                                                                    <option value='{{ $familyName->id }}'
                                                                        {{ $familyName->id == old('family_names_id')[$key] ? 'selected' : '' }}>
                                                                        {{ ucfirst($familyName['name_' . $currentLanguage]) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            {{-- Validation --}}
                                                            <div
                                                                class="text-danger d-none required-validate-error mb-3">
                                                                @lang('site.data-required')
                                                            </div>
                                                             @error("family_names_id.$loop->index")
                                                                        <div class="text-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                        </div>

                                                        <input type="hidden" name="items[]" value="any">

                                                        <div class="col-12 col-lg-6 no-gutters">
                                                            <div class="form-row no-gutters">

                                                                {{-- Quantity required --}}
                                                                <div class="col-md-3 mb-1 pl-md-0 pl-lg-1">
                                                                    <input type="number" name="quantities[]"
                                                                        placeholder="@lang('site.quantity_required')"
                                                                        class="form-control qrtp" min=1 value="{{ old('quantities')[$key] }}" />
                                                                    {{-- Validation --}}
                                                                    <div
                                                                        class="text-danger d-none required-validate-error mb-3">
                                                                        @lang('site.data-required')
                                                                    </div>
                                                                    @error("quantities.$loop->index")
                                                                        <div class="text-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror

                                                                </div>

                                                                {{-- Quantity in store --}}
                                                                <div class="col-md-3 mb-1 no-gutters">
                                                                    <input type="number" name="stock_quantities[]" min=0
                                                                        placeholder="@lang('site.quantity_in_store')"
                                                                        class="form-control qos"  value="{{ old('stock_quantities')[$key] }}"/>
                                                                    {{-- Validation --}}
                                                                    <div
                                                                        class="text-danger d-none required-validate-error mb-3">
                                                                        @lang('site.data-required')
                                                                    </div>
                                                                    @error("stock_quantities.$loop->index")
                                                                        <div class="text-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror

                                                                </div>

                                                                {{-- Actual quantity --}}
                                                                <div class="col-md-3 mb-1 no-gutters">
                                                                    <input type="number" name="actual_quantities[]"
                                                                        min=0 placeholder="@lang('site.actual_quantity')"
                                                                        class="form-control aqrtp" value="{{ old('actual_quantities')[$key] }}"/>
                                                                    {{-- Validation --}}
                                                                    <div
                                                                        class="text-danger d-none required-validate-error mb-3">
                                                                        @lang('site.data-required')
                                                                    </div>
                                                                    @error("actual_quantities.$loop->index")
                                                                        <div class="text-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>

                                                                {{-- Units --}}
                                                                <div class="col-md-3 mb-1">
                                                                    <select name="units_id[]" class="form-control unit">
                                                                        <option value="" selected hidden>
                                                                            @lang('site.Unit')
                                                                        </option>
                                                                        @foreach ($units as $unit)

                                                                            <option value="{{ $unit->id }}"
                                                                                @if(old('units_id')[$key] ==  $unit->id  ) {{ 'selected' }} @endif >
                                                                                {{ $unit['name_' . $currentLanguage] }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                      @error("units_id.$loop->index")
                                                                        <div class="text-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                    {{-- Validation --}}
                                                                    <div
                                                                        class="text-danger d-none required-validate-error mb-3">
                                                                        @lang('site.data-required')
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="form-row m-1 no-gutters">

                                                        {{-- Specification --}}
                                                        <div class="col-md-6  mb-1">
                                                            <textarea type="text" name="specifications[]"
                                                                placeholder="@lang('site.Add') @lang('site.specifications')"
                                                                class="form-control specification" rows="3" cols="10">{{ old('specifications')[$key] }}</textarea>
                                                            <div
                                                                class="text-danger d-none required-validate-error mb-3">
                                                                @lang('site.data-required')
                                                            </div>
                                                          @error("specifications.$loop->index")
                                                                        <div class="text-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                        </div>


                                                        {{-- Comment --}}
                                                        <div class="col-md-4  mb-1 no-gutters">
                                                            <div class="col-md-12">
                                                                <textarea type="text" name="comments[]"
                                                                    placeholder="@lang('site.Add') @lang('site.Comment')"
                                                                    class="form-control" rows="3"
                                                                    cols="10">{{ old('comments')[$key] }}</textarea>
                                                            </div>
                                                          @error("comments.$loop->index")
                                                                        <div class="text-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                        </div>

                                                        {{-- Priority --}}
                                                        <div class="col-md-2 mb-1">
                                                            <div class="form-row m-0">
                                                                {{-- <div class="col-md-12"> --}}
                                                                <select name="priorities[]"
                                                                    class="form-control priority" placeholder="priority"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="priority">
                                                                    <option value="" selected>@lang('site.Priority')
                                                                    </option>
                                                                    <option @if(old('priorities')[$key] ==  'L'  ) {{ 'selected' }} @endif value="L">@lang('site.Priority_L')</option>
                                                                    <option @if(old('priorities')[$key] ==  'M'  ) {{ 'selected' }} @endif value="M">@lang('site.Priority_M')
                                                                    </option>
                                                                    <option  @if(old('priorities')[$key] ==  'H'  ) {{ 'selected' }} @endif value="H">@lang('site.Priority_H')</option>
                                                                </select>
                                                                {{-- Validation --}}
                                                                <div
                                                                    class="text-danger d-none required-validate-error mb-3">
                                                                    @lang('site.data-required')
                                                                </div>
                                                          @error("priorities.$loop->index")
                                                                        <div class="text-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                {{-- Control buttons --}}
                                                <div class="col-md-1 text-center control-buttons">

                                                    {{-- Edit --}}
                                                    <div class="row-form mt-2 mb-1">
                                                        <button type="button" id='edit_row'
                                                            class="edit_row rounded-pill btn btn-warning btn-sm"
                                                            data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                class="far fa-edit"></i></button>
                                                    </div>

                                                    {{-- Copy --}}
                                                    <div class="row-form mb-1">
                                                        <button type="button" id='copy_row'
                                                            class="copy_row rounded-pill btn btn-info btn-sm"
                                                            data-toggle="tooltip" data-placement="top" title="Copy"><i
                                                                class="far fa-copy"></i></button>
                                                    </div>

                                                    {{-- Delete --}}
                                                    <div class="row-form ">
                                                        <button type="button" id='delete_row'
                                                            class="delete_row rounded-pill btn btn-danger btn-sm"
                                                            data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                class="fas fa-minus-circle"></i></button>
                                                    </div>

                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        @empty
                                        @foreach ($purchaseRequest->itemRequests as $index => $item)
                                            <div class="tr">
                                                <div class="row">
                                                    <div class="col-md-11">
                                                        <div class="form-row m-1 no-gutters">
                                                            {{-- subGroup --}}
                                                            <div class="col-12 col-md-6 col-lg-3 mb-1 pl-0">
                                                                <select
                                                                    class="form-control SelectProduct getSubGroup required-data"
                                                                    data-toggle="tooltip" data-placement="top"
                                                                    title="Sub Group">
                                                                    @foreach ($subGroups as $subGroup)
                                                                        <option value="{{ $subGroup->id }}"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Sub Group" @if ($subGroup->id === $item->familyName()->pluck('sub_group_id')[0]) {{ 'selected' }} @endif>
                                                                            {{ $subGroup['name_' . $currentLanguage] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                {{-- Validation --}}
                                                                <div
                                                                    class="text-danger d-none required-validate-error mb-3">
                                                                    @lang('site.data-required')
                                                                </div>
                                                            </div>

                                                            {{-- FamilyName --}}
                                                            <div class="col-12 col-md-6 col-lg-3 mb-1">
                                                                <select name="family_names_id[]" class="form-control SelectItem Getitems required-data">
                                                                    @foreach ($item->familyName->subGroup->FamilyNames as $familyName)

                                                                    <option value="{{ $familyName->id }}"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Item" @if ($familyName->id === $item->product_id) {{ 'selected' }} @endif>
                                                                            {{ $familyName['name_' . $currentLanguage] }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                {{-- Validation --}}
                                                                <div
                                                                    class="text-danger d-none required-validate-error mb-3">
                                                                    @lang('site.data-required')
                                                                </div>
                                                            </div>

                                                            <div><input type="hidden" name="items[]" value="any"></div>

                                                            <div class="col-12 col-lg-6 no-gutters">
                                                                <div class="form-row no-gutters">
                                                                    {{-- Quantity required --}}
                                                                    <div class="col-md-3 mb-1 pl-md-0 pl-lg-1">
                                                                        <input type="number" name="quantities[]"
                                                                            placeholder="@lang('site.quantity_required')"
                                                                            class="form-control qrtp required-data" min=1
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="QTY Required"
                                                                            value="{{ $item->quantity }}" />
                                                                        {{-- Validation --}}
                                                                        <div
                                                                            class="text-danger d-none required-validate-error mb-3">
                                                                            @lang('site.data-required')
                                                                        </div>
                                                                    </div>

                                                                    {{-- Quantity in store --}}
                                                                    <div class="col-md-3 mb-1 no-gutters">
                                                                        <input type="number" name="stock_quantities[]"
                                                                            placeholder="@lang('site.quantity_in_store')"
                                                                            class="form-control qos required-data"
                                                                            value="{{ $item->stock_quantity }}"
                                                                            min="0" />
                                                                        {{-- Validation --}}
                                                                        <div
                                                                            class="text-danger d-none required-validate-error mb-3">
                                                                            @lang('site.data-required')
                                                                        </div>
                                                                    </div>

                                                                    {{-- Actual quantity --}}
                                                                    <div class="col-md-3 mb-1 no-gutters">
                                                                        <input type="number" name="actual_quantities[]"
                                                                            placeholder="@lang('site.actual_quantity')"
                                                                            class="form-control aqrtp"
                                                                            value="{{ $item->actual_quantity }}"
                                                                            min="0" />
                                                                    </div>

                                                                    {{-- Units --}}
                                                                    <div class="col-md-3 mb-1">
                                                                        <select name="units_id[]" class="form-control unit"
                                                                            data-toggle="tooltip" data-placement="top"
                                                                            title="Unit">
                                                                            <option value="" hidden>
                                                                                @lang('site.Unit')
                                                                            </option>
                                                                            @foreach ($units as $unit)
                                                                                <option value="{{ $unit->id }}"
                                                                                    @if ($unit->id == $item->unit_id) {{ 'selected' }} @endif>
                                                                                    {{ $unit['name_' . $currentLanguage] }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-row mx-0">

                                                            {{-- Specification --}}
                                                            <div class="col-md-6 mb-1">
                                                                {{-- <div class="col-md-12"> --}}
                                                                <textarea type="text" name="specifications[]"
                                                                    placeholder="@lang('site.Add') @lang('site.specifications')"
                                                                    class="form-control specification"
                                                                    value="{{ old('specifications.' . $index) ?? '' }}"
                                                                    rows="3" cols="10" data-toggle="tooltip"
                                                                    data-placement="top"
                                                                    title="Specification...">{{ $item->specification }}</textarea>
                                                            </div>

                                                            {{-- Comment --}}
                                                            <div class="col-md-4 mb-1 no-gutters">
                                                                <div class="col-md-12">
                                                                    <textarea type="text" name="comments[]"
                                                                        placeholder="@lang('site.Add') @lang('site.Comment')"
                                                                        class="form-control" rows="3" cols="10"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="Comment...">{{ $item->comment }}</textarea>
                                                                </div>
                                                            </div>

                                                            {{-- Priority --}}
                                                            <div class="col-md-2 mb-1">
                                                                <div class="form-row m-0">
                                                                    {{-- <div class="col-md-12"> --}}
                                                                    <select name="priorities[]" id="priorities"
                                                                        class="form-control priority" placeholder="priority"
                                                                        data-toggle="tooltip" data-placement="top"
                                                                        title="priority">
                                                                        <option value="">@lang('site.Priority')
                                                                        </option>
                                                                        <option value="L" @if ('L' === $item->priority) {{ 'selected' }} @endif>@lang('site.Priority_L')</option>
                                                                        <option value="M" @if ('M' === $item->priority) {{ 'selected' }} @endif>@lang('site.Priority_M')</option>
                                                                        <option value="H" @if ('H' === $item->priority) {{ 'selected' }} @endif>@lang('site.Priority_H')</option>
                                                                    </select>
                                                                    {{-- Validation --}}
                                                                    <div
                                                                        class="text-danger d-none required-validate-error mb-3">
                                                                        @lang('site.data-required')
                                                                    </div>
                                                                </div>
                                                            </div>

                                                                          {{-- Logo --}}
                                                        <div class="col-md-6">
                                                            <div class="input-group mb-3">
                                                                <input type="file" name="file" 
                                                                    class="custom-file-input w-auto ml-auto"
                                                                    id="logo_image_id">
                                                                    <div
                                                                    class="text-danger d-none required-validate-error mb-3">
                                                                    @lang('site.data-required')
                                                                </div>
                                                                <label
                                                                    class="custom-file-label text-overflow-dots rounded-0 m-0"
                                                                    style=" text-overflow: ellipsis; overflow: hidden; color: #999"
                                                                    for="logo_image_id">
                                                                    @lang('site.add_file')

                                                                </label>
                                                                <div
                                                                    class="text-danger d-none required-validate-error mb-3">
                                                                    @lang('site.data-required')
                                                                </div>
                                                            </div>
                                                            @error('file')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>

                                                {{-- comment_reason --}}
                                                <div class="col-md-6  mb-1">
                                               
                                                    <textarea type="text" name="comment_reason"
                                                    placeholder="@lang('site.reason_period')"  
                                                    class="form-control comment_reason @if ($purchaseRequest->comment_reason !== null)
                                                        edit_reason
                                                    @endif " rows="3" cols="10"
                                                    title="@lang('site.reason_period')...">
                                                    {{$purchaseRequest->comment_reason}}
                                                </textarea>
                                                    <div
                                                    class="text-danger d-none required-validate-error mb-3">
                                                    @lang('site.data-required')

                                                </div>
                                                        </div>
                                                            </div>

                                                        {{-- ID --}}
                                                        <input type="hidden" class="purchaseRequestId"
                                                            name="ids[]"
                                                            value="{{ $item->id }}">
                                                    </div>

                                                    {{-- Controll buttons --}}
                                                    <div class="col-md-1">

                                                        {{-- Edit --}}
                                                        <div class="row-form mt-2 mb-1">
                                                            <button type="button" id='edit_row'
                                                                class="edit_row rounded-pill btn btn-warning btn-sm"
                                                                data-toggle="tooltip" data-placement="top" title="Edit"><i
                                                                    class="far fa-edit"></i></button>
                                                        </div>

                                                        {{-- Copy --}}
                                                        <div class="row-form mb-1">
                                                            <button type="button" id='copy_row'
                                                                class="copy_row rounded-pill btn btn-info btn-sm copy_row"
                                                                data-toggle="tooltip" data-placement="top" title="Copy"><i
                                                                    class="far fa-copy"></i></button>
                                                        </div>

                                                        {{-- Delete --}}
                                                        <div class="row-form ">
                                                            <button type="button" id="delete_row"
                                                                class="delete_row rounded-pill btn btn-danger btn-sm"
                                                                data-toggle="tooltip" data-placement="top" title="Delete"><i
                                                                    class="fas fa-minus-circle"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>

                                            </div>
                                        @endforeach
                                        @endforelse
                                    </div>

                                    {{-- Add item --}}
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="button" id="add_row" class="btn btn-dark pull-left rounded-pill"
                                                data-toggle="tooltip" data-placement="top" title="Add Row"><i
                                                    class="fas fa-plus-circle"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mr-3">
                                    <button class="btn btn-primary" name="save" type="submit" data-toggle="tooltip"
                                        data-placement="top" title="Save"><i class="far fa-save"></i></button>
                                </div>
                                <div>
                                    <button class="btn btn-success" name="saveandsend" type="submit" data-toggle="tooltip"
                                        data-placement="top" title="Save & Send"><i
                                            class="fas fa-paper-plane"></i></button>
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
    <script src="{{ asset('plugins/jquery/shake.js') }}"></script>
    <script>
        /*  define select2  */
        $('#group').select2({
            placeholder: "@lang('site.Choose') @lang('site.group')",
        });
        $('#project').select2({
            placeholder: "@lang('site.Choose') @lang('site.project')",
        });
        $('#site').select2({
            placeholder: "@lang('site.Choose') @lang('site.site')",
        });
        /*  End defining select2  */


        $(document).ready(function() {
            Date.prototype.toDateInputValue = (function() {
                var local = new Date(this);
                local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
                return local.toJSON().slice(0, 10);
            });
            if ($(".tr").length <= 1) {
                $('#delete_row').hide();
            }
            if ($(".tr").length <= 1) {
                $('#edit_row').hide();
            }

            // Disable all old inputs
            if ($(".tr").length > 1) {
                $('.delete_row').show();
                $('.edit_row').show();
                // $('.copy_row').hide();
                let $table = $('.table');
                $table.find('input[type=number]').prop('readonly', true);
                $table.find('input[type=text]').prop('readonly', true);
                $table.find('input[type=date]').prop('readonly', true);
                $table.find('textarea').prop('readonly', true);
                $table.find('select').attr("disabled", true);
            }

            var indexCount = 1;
            $('.productOrServiceSelect').select2();
            $('.getSubGroup').select2();
            $('.getSubGroup').select2({
                placeholder: "@lang('site.Choose') @lang('site.sub_group')",
            });
            $('.Getitems').select2();
            $('.Getitems').select2({
                placeholder: "@lang('site.Choose') @lang('site.family_name')",
            });
            $('#date').val(new Date().toDateInputValue());
            $('.budgetforpiece').prop('readonly', true);

            // Add item button
            $("#add_row").click(function(e) {
                e.preventDefault();
                $('#delete_row').show();
                $('.edit_row').show();
                let $table = $('.table');
                $table.find('.tr').first().each(function() {
                    $(this).find(".SelectProduct").removeClass(
                        'productOrServiceSelect');
                    $(this).find('.getSubGroup').select2("destroy");
                    $(this).find(".SelectProduct").removeClass('getSubGroup');
                    $(this).find('.Getitems').select2("destroy");
                    $(this).find(".SelectItem").removeClass('Getitems');
                    $(this).find(".SelectProduct").removeClass('productOrServiceSelect')
                        .addClass(
                            'productOrServiceSelect');
                    $(this).find(".SelectProduct").removeClass('getSubGroup').addClass(
                        'getSubGroup');
                    $(this).find(".SelectItem").removeClass('Getitems').addClass(
                        'Getitems');
                });

                $table.find('input[type=number]').prop('readonly', true);
                $table.find('input[type=text]').prop('readonly', true);
                $table.find('input[type=date]').prop('readonly', true);
                $table.find('textarea').prop('readonly', true);
                $table.find('select').attr("disabled", true);

                let $top = $table.find('div.tr').first();
                let $new = $top.clone(true);
                $table.append($new);
                $new.find('.purchaseRequestId').val('');
                $new.find('input[type=text]').val('');
                $new.find('input[type=number]').val('');
                $new.find('textarea').val('');
                $new.find('input[type=number]').prop('readonly', false);
                $new.find('input[type=text]').prop('readonly', false);
                $new.find('input[type=date]').prop('readonly', false);
                $new.find('textarea').prop('readonly', false);
                $new.find('select').attr("disabled", false);
                $new.find('select').prop("selectedIndex", 0);
                $new.find('.getSubGroup')               // Append New Option To select
                .append($('<option>')
                    .val("")
                    .text("")
                    .prop("selected", true)
                    );
                $new.find('.Getitems')                   // Append New Option To select
                .append($('<option>')
                    .val("")
                    .text("")
                    .prop("selected", true)
                    );
                $new.find('select,input,textarea').css( "border", "1px solid #ced4da" );
                $new.find('.edit_row').hide();

                $new.find(".SelectProduct").removeClass('productOrServiceSelect').addClass(
                    'productOrServiceSelect');
                $new.find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
                $new.find(".SelectItem").removeClass('Getitems').addClass('Getitems');
                $new.find('.getSubGroup').select2();
                $new.find('.getSubGroup').select2({
                    placeholder: "@lang('site.Choose') @lang('site.sub_group')",
                });
                $new.find('.Getitems').select2();
                $new.find('.Getitems').select2({
                    placeholder: "@lang('site.Choose') @lang('site.family_name')",
                });

            });

            // Edit item button
            $(".edit_row").click(function(e) {
                e.preventDefault();
                let $table = $('.table');
                // Edit all table to destroy all other row
                $table.find('.tr').first().each(function() {

                    $(this).find(".SelectProduct").removeClass(
                        'productOrServiceSelect');
                    $(this).find('.getSubGroup').select2("destroy");
                    $(this).find(".SelectProduct").removeClass('getSubGroup');

                    $(this).find('.Getitems').select2("destroy");
                    $(this).find(".SelectItem").removeClass('Getitems');
                    $(this).find(".SelectProduct").removeClass('productOrServiceSelect')
                        .addClass(
                            'productOrServiceSelect');
                    $(this).find(".SelectProduct").removeClass('getSubGroup').addClass(
                        'getSubGroup');
                    $(this).find(".SelectItem").removeClass('Getitems').addClass(
                        'Getitems');
                });

                $(".SelectProduct").removeClass('productOrServiceSelect').addClass(
                    'productOrServiceSelect');
                $(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
                $(".SelectItem").removeClass('Getitems').addClass('Getitems');
                $('.productOrServiceSelect').select2();
                $('.SelectProduct').select2();
                $('.getSubGroup').select2();
                $('.Getitems').select2();
                $('.Getitems').select2();

                $table.find('input[type=number]').prop('readonly', true);
                $table.find('input[type=text]').prop('readonly', true);
                $table.find('input[type=date]').prop('readonly', true);
                $table.find('textarea').prop('readonly', true);
                $table.find('select').attr("disabled", true);

                $('.tr').removeClass('asd');
                $(this).parents('.tr').addClass('asd');
                $('.asd select .SelectProduct .SelectItem').select2();

                let $new = $('.asd');
                $new.find('input[type=number]').prop('readonly', false);
                $new.find('input[type=text]').prop('readonly', false);
                $new.find('input[type=date]').prop('readonly', false);
                $new.find('textarea').prop('readonly', false);
                $new.find('select').attr("disabled", false);

                $('.edit_row').show();
                $new.find('.edit_row').hide();

                $(this).parents('.tr').find(".SelectProduct").removeClass(
                        'productOrServiceSelect')
                    .addClass('productOrServiceSelect');
                $(this).parents('.tr').find(".SelectProduct").removeClass('getSubGroup')
                    .addClass(
                        'getSubGroup');
                $(this).parents('.tr').find(".SelectItem").removeClass('Getitems').addClass(
                    'Getitems');

                $(this).parents('.tr').find('.productOrServiceSelect').select2();
                $(this).parents('.tr').find('.getSubGroup').select2();
                $(this).parents('.tr').find('.getSubGroup').select2({
                    placeholder: "@lang('site.Choose') @lang('site.sub_group')",
                });
                $(this).parents('.tr').find('.Getitems').select2();
                $(this).parents('.tr').find('.Getitems').select2({
                    placeholder: "@lang('site.Choose') @lang('site.family_name')",
                });
            });

            // Copy item button
            $(".copy_row").click(function(e) {
                e.preventDefault();
                $('#delete_row').show();

                $('.edit_row').show();
                const $table = $('.table');
                let $tr = $(this).parents('.tr');

                $table.find('.tr').first().each(function() {
                    // $(this).find('.productOrServiceSelect').select2("destroy");
                    $(this).find(".SelectProduct").removeClass('productOrServiceSelect');
                    // $(this).find('.getSubGroup').select2("destroy");
                    $(this).find(".SelectProduct").removeClass('getSubGroup');
                    // }
                    // if ($(this).find(".Getitems")[0]){
                    // $(this).find('.Getitems').select2("destroy");
                    $(this).find(".SelectItem").removeClass('Getitems');
                    $(this).find(".SelectProduct").removeClass('productOrServiceSelect').addClass(
                        'productOrServiceSelect');
                    $(this).find(".SelectProduct").removeClass('getSubGroup').addClass(
                        'getSubGroup');
                    $(this).find(".SelectItem").removeClass('Getitems').addClass('Getitems');
                });

                $table.find('input[type=number]').prop('readonly', true);
                $table.find('input[type=text]').prop('readonly', true);
                $table.find('input[type=date]').prop('readonly', true);
                $table.find('textarea').prop('readonly', true);
                $table.find('select').attr("disabled", true);

                $tr.find(".SelectProduct").removeClass('productOrServiceSelect').addClass(
                    'productOrServiceSelect');
                $tr.find(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
                $tr.find(".SelectItem").removeClass('Getitems').addClass('Getitems');

                let $new = $tr.clone(true);
                $tr.after($new);

                $new.find('input[type=number]').prop('readonly', false);
                $new.find('input[type=text]').prop('readonly', false);
                $new.find('input[type=date]').prop('readonly', false);
                $new.find('textarea').prop('readonly', false);
                $new.find('select').attr("disabled", false);
                $new.find('select').val(function(index, value) {
                    return $tr.find('select').eq(index).val();
                });
                $new.find('select,input,textarea').css( "border", "1px solid #ced4da" ); //#ced4da
                $new.find('.edit_row').hide();

                $(".SelectProduct").removeClass('productOrServiceSelect').addClass(
                    'productOrServiceSelect');
                $(".SelectProduct").removeClass('getSubGroup').addClass('getSubGroup');
                $(".SelectItem").removeClass('Getitems').addClass('Getitems');
                $new.find('.productOrServiceSelect').select2();
                $new.find('.getSubGroup').select2();
                $new.find('.getSubGroup').select2({
                    placeholder: "@lang('site.choose') @lang('site.small_sub_group')",
                });
                $new.find('.Getitems').select2();
                $new.find('.Getitems').select2({
                    placeholder: "@lang('site.choose') @lang('site.small_family_name')",
                });

                $new.find('.select2.select2-container.select2-container--default').next(
                    '.select2.select2-container.select2-container--default').each(function(index,
                    element) {
                    $(element).remove();
                })

            });

            // Delete item button
            $(".delete_row").click(function(e) {
                $('#delete_row').show();
                $(this).parents('.tr').remove();

                if ($(".tr").length <= 1) {
                    $('#delete_row').hide();
                    $('#edit_row').hide();
                    $(".tr").find('input[type=number]').prop('readonly', false);
                    $(".tr").find('input[type=text]').prop('readonly', false);
                    $(".tr").find('input[type=date]').prop('readonly', false);
                    $(".tr").find('textarea').prop('readonly', false);
                    $(".tr").find('select').attr("disabled", false);

                    $('.getSubGroup').select2({
                        placeholder: "@lang('site.Choose') @lang('site.sub_group')",
                    });
                    $('.Getitems').select2({
                        placeholder: "@lang('site.Choose') @lang('site.family_name')",
                    });
                }
            });

            $('.currency').on('change', function() {
                $(this).parents('.tr').find('.budgetforpiece').prop('readonly', false);
            });

               /* get sub group by choose group */
         $(document).on('change', '#priorities', function() {
            $value = $(this).val();
            if($value == "H") {
                $('.comment_reason').addClass('reason_comment');
                $('.comment_reason').text("@lang('site.reason_period')...");
                $('.comment_reason').show();
                
            } else {
                $('.comment_reason').addClass('reason_comment');
                $('.comment_reason').text("");
                $('.comment_reason').hide();
            }
        });

            // Sbstraction 2 values to get actual quantity to purchase
            $('#items_table').on('keydown keyup', '.tr', function() {
                let qrtp = $(this).find('.qrtp').val();
                let qos = $(this).find('.qos').val();
                let aqrtp = $(this).find('.aqrtp');
                // Total Row budget
                var totalVaules = [];
                var holderSummution = {};
                var newArraySummution = [];
                if (!isNaN($(this).find('.budgetforpiece').val())) {
                    $('.budgetforpiece').each(function() {
                        let budgetforpiece = Number($(this).val());
                        let aqrtp = $(this).parents('.tr').find('.aqrtp').val();
                        let currencysymbol = $(this).parents('.tr').find('.currency')
                            .val();
                        let totalrowbudget = aqrtp * budgetforpiece;
                        let rowbudget = $(this).parents('.tr').find('.rowbudget');
                        $(rowbudget).val(totalrowbudget);
                        totalVaules.push({
                            budget: totalrowbudget,
                            currency: currencysymbol
                        });
                    });
                }
                // array summution budget
                totalVaules.forEach(function(d) {
                    if (holderSummution.hasOwnProperty(d.currency)) {
                        holderSummution[d.currency] = holderSummution[d.currency] + d
                            .budget;
                    } else {
                        holderSummution[d.currency] = d.budget;
                    }
                });
                for (var prop in holderSummution) {
                    newArraySummution.push({
                        budget: holderSummution[prop],
                        currency: prop + ' + '
                    });
                }
                var sumrowbudget = ' ';
                $.each(newArraySummution, function(k, v) {
                    for (var prop in v) {
                        sumrowbudget += v[prop];
                        $('.sumrowbudget').val(sumrowbudget);
                    }
                });
            });
        });


        $('.updatePurchaseRequest').submit(function(event) {
            var validation = formValidation(); // form validation
            if (!validation) { // check of validation
                event.preventDefault();
                return;
           }
            $("select").prop('disabled', false);
        });

        // Make Site required if user select project
        $('select[name=project]').on('propertychange change input', function() {
            if ($(this).val() != '') {
                // $('#provinceselect').show();
                $('#site').prop('required', true);
            } else {
                $('#site').prop('required', false);
                // {{-- $('#site').removeClass('invalid-feedback'); --}}
                // $('#provinceselect').hide();
            }
        });

        /* get sub group by choose group */
        $(document).on('change', '#group', function() {
            $('.SelectProduct').empty();
            $('.Getitems').empty();
            var groupId = $(this).val();
            if (groupId) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route('group.fetch_related_sub_group') }}',
                    data: {
                        groupId: groupId
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        $('.SelectProduct').empty();
                        $('.SelectProduct').prop('disabled', false);
                        if (data.status) {
                            data.subGroups.forEach(subGroup => {
                                $('.SelectProduct').append(
                                    `<option></option><option value="${subGroup['id']}">${subGroup['name_'+urlLang]}</option>`
                                );
                            });
                            $('.table .tr:not(:first)').remove();
                            $('.table .tr:first .getSubGroup').select2({
                                placeholder: "@lang('site.Choose') @lang('site.sub_group')",
                            });
                            $('.table .tr:first .Getitems').select2({
                                placeholder: "@lang('site.Choose') @lang('site.family_name')",
                            });
                            $('#delete_row').hide();
                            $('#edit_row').hide();
                            $(".tr").find('input[type=number]').prop('readonly', false);
                            $(".tr").find('input[type=text]').prop('readonly', false);
                            $(".tr").find('input[type=date]').prop('readonly', false);
                            $(".tr").find('textarea').prop('readonly', false);
                            $(".tr").find('select').attr("disabled", false);
                        } else {
                            console.log('Error occur');
                        }
                    }
                });
            }
        });

        /* get family names by choose sub groups */
        $('.SelectProduct').each(function() {
            $(this).on('propertychange change keyUp keyDown', function(e) {
                var subGroupId = $(this).val();
                let _this = $(this);
                _this.parents('.tr').find('.SelectItem').empty();
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
                            var data = JSON.parse(data);
                            _this.parents('.tr').find('.SelectItem').prop(
                                'disabled', false);
                            data.familyNames.forEach(familyName => {
                                _this.parents('.tr').find('.SelectItem')
                                    .append(
                                        `<option value=""></option><option value="${familyName['id']}">${familyName['name_'+urlLang]}</option>`
                                    );
                            });
                        }
                    });
                }
            });
        });

        /* get job names by choose job code */
        $('#project').on('change', function() {

            $('#site').html('');
            var projectId = $(this).val();
            if (projectId) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: '{{ route('project.fetch_related_site') }}',
                    data: {
                        projectId: projectId
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        if (data.status) {
                            $('.site-section').removeClass('d-none');
                            $('#site').prop('disabled', false);
                            data.sites.forEach(site => {
                                $('#site').append(
                                    `<option></option><option value="${site.id}">${site['name_'+urlLang]}</option>`
                                )
                            });
                        } else {
                            console.log('Error occur');
                        }
                    }
                });
            }
        });

        // check on change value
        $('.project,.group,.getSubGroup,.Getitems,.qrtp,.qos,.aqrtp,.unit,.specification,.priority')
        .on('change', function () {
            $(this).parent().find('select,input,textarea,.select2-selection--single')
            .css( "border", "1px solid #ced4da");
        });

        // Form Validation Function
        function formValidation(){
            let valid = true;
            $('.project,.group,.getSubGroup,.Getitems,.qrtp,.qos,.aqrtp,.unit,.specification,.priority')
            .each(function () {
                if ($(this).val() == '') { // check if value empty
                    $(this).parent().shake();
                    $(this).parent()
                    .find('select,input,textarea,.select2-selection--single')
                    .css( "border", "1px solid red" );
                    valid = false;
                }
            });
            return valid;
        }
    </script>
@endsection
