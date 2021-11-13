@php
$currentLanguage = app()->getLocale();
$name = 'name_' . $currentLanguage;
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'approval_show',
// 'child' => 'show',
])


{{-- Custom Title --}}
@section('title')
@lang('site.Approval_cycles')
@endsection

{{-- Custom Styles --}}
@section('styles')
<style>
    /* time line */
    main.stepline {
        min-width: 300px;
        max-width: 500px;
        margin: auto;
    }

    .stepline .item {
        font-size: 1em;
        line-height: 1.75em;
        border-top: 4px solid;
        border-image: linear-gradient(to right, #66ff80 0%, #228639 100%);
        border-image-slice: 1;
        border-width: 3px;
        margin: 0;
        padding: 40px;
        counter-increment: section;
        position: relative;
        color: #333;
    }

    .stepline .item:before {
        content: counter(section);
        position: absolute;
        border-radius: 50%;
        padding: 10px;
        background-color: #2b4c32;
        text-align: center;
        line-height: 15px;
        color: #fff;
        font-size: 1em;
        height: 35px;
        width: 35px;
    }

    .stepline .item:nth-child(odd) {
        border-right: 3px solid;
        padding-left: 0;
    }

    .stepline .item:nth-child(odd):before {
        left: 100%;
        margin-left: -16px;
    }

    .stepline .item:nth-child(even) {
        border-left: 3px solid;
        padding-right: 0;
    }

    .stepline .item:nth-child(even):before {
        right: 100%;
        margin-right: -16px;
    }

    .stepline .item:first-child {
        border-top: 0;
        border-top-right-radius: 0;
        border-top-left-radius: 0;
    }

    .stepline .item:last-child {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .stepline .item span {
        background: #28a745;
        color: #FFF;
        padding: 0 10px;
        border-radius: 5px;
        font-size: 14px;
        display: inline-block;
        margin-top: 5px;
    }
</style>
@endsection

{{-- Page content --}}
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                @lang('site.Show') @lang('site.approval_cycle')
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('site.Home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('approvals.index') }}">@lang('site.Approval_cycles')</a></li>
                    <li class="breadcrumb-item active">@lang('site.Purchase_request')</li>
                    <!-- $order->['table_name_' . $currentLanguage] -->
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content" style="position: relative">



    {{-- Order basic data --}}
    <div class="active tab-pane" id="activity">
 
        <div class="container">
        <div class="row">
            {{-- المنشئ --}}
            <div class="supplier-info col-md-6">
                <div class="header-info">
                    <i class="fas fa-location-arrow"></i> @lang('site.Creator')
                </div>
                <div class="body-info">
                    {{ $purchaseOrder->requester['name_' . $currentLanguage] }}
                </div>
            </div>

            {{-- التاريخ --}}
            <div class="supplier-info col-md-6">
                <div class="header-info">
                    <i class="fas fa-location-arrow"></i> @lang('site.Date')
                </div>
                <div class="body-info">
                    {{ $order->created_at }}
                </div>
            </div>

            {{-- قطاع --}}
            <div class="supplier-info col-md-6">
                <div class="header-info">
                    <i class="fas fa-location-arrow"></i> @lang('site.the_sector')
                </div>
                <div class="body-info">
                    {{ $purchaseOrder->sector['name_' . $currentLanguage] }}
                </div>
            </div>

            {{-- قسم --}}
            <div class="supplier-info col-md-6">
                <div class="header-info">
                    <i class="fas fa-location-arrow"></i> @lang('site.the_department')
                </div>
                <div class="body-info">
                    @if ($purchaseOrder->department)
                    {{ $purchaseOrder->department['name_' . $currentLanguage]}}
                    @else
                    @lang('site.not_available')</span> </a>
                    @endif
                </div>
            </div>

            {{-- مشروع --}}
            <div class="supplier-info col-md-6">
                <div class="header-info">
                    <i class="fas fa-location-arrow"></i> @lang('site.the_project')
                </div>
                <div class="body-info">
                    @if ($purchaseOrder->project)
                    {{ $purchaseOrder->project['name_' . $currentLanguage]}}
                    @else
                    @lang('site.not_available')</span> </a>
                    @endif
                </div>
            </div>

            {{-- التصنيف الرئيسى --}}
            <div class="supplier-info col-md-6">
                <div class="header-info">
                    <i class="fas fa-location-arrow"></i> @lang('site.the_group')
                </div>
                <div class="body-info">
                    {{ $purchaseOrder->group['name_' . $currentLanguage] }}
                </div>
            </div>
           
            @foreach ($itemsorders as $itemsorder)

            <p style="align-items: center; margin:auto;font-size:40px">@lang('site.the_items') </p>
            <div class="row">
                {{-- العائله --}}
                <div class="supplier-info col-md-6">
                    <div class="header-info">
                        <i class="fas fa-location-arrow"></i> @lang('site.the_family_name')
                    </div>
                    <div class="body-info">
                        {{ $itemsorder->familyName['name_' . $currentLanguage] }}
                    </div>
                </div>

                {{-- الكميه المطلوبه --}}
                <div class="supplier-info col-md-6">
                    <div class="header-info">
                        <i class="fas fa-location-arrow"></i> @lang('site.quantity_required')
                    </div>
                    <div class="body-info">
                        {{ $itemsorder->quantity}}
                    </div>
                </div>
                {{-- الكميه فى المخزن--}}
                <div class="supplier-info col-md-6">
                    <div class="header-info">
                        <i class="fas fa-location-arrow"></i> @lang('site.quantity_in_store')
                    </div>
                    <div class="body-info">
                        {{ $itemsorder->stock_quantity }}
                    </div>
                </div>
                {{-- الكميه الفعليه--}}
                <div class="supplier-info col-md-6">
                    <div class="header-info">
                        <i class="fas fa-location-arrow"></i> @lang('site.actual_quantity')
                    </div>
                    <div class="body-info">
                        {{ $itemsorder->actual_quantity }}
                    </div>
                </div>
                {{-- الوحده--}}
                <div class="supplier-info col-md-6">
                    <div class="header-info">
                        <i class="fas fa-location-arrow"></i> @lang('site.Unit')
                    </div>
                    <div class="body-info">
                        {{ $itemsorder->unit['name_' . $currentLanguage] }}
                    </div>
                </div>

                {{-- المواصفات--}}
                <div class="supplier-info col-md-6">
                    <div class="header-info">
                        <i class="fas fa-location-arrow"></i> @lang('site.specifications')
                    </div>
                    <div class="body-info">
                        {{ $itemsorder->specification }}
                    </div>
                </div>
                {{-- التعليق--}}
                <div class="supplier-info col-md-6">
                    <div class="header-info">
                        <i class="fas fa-location-arrow"></i> @lang('site.Comment')
                    </div>
                    <div class="body-info">
                        {{ $itemsorder->comment }}
                    </div>
                </div>
                {{-- الاولويه--}}
                <div class="supplier-info col-md-6">
                    <div class="header-info">
                        <i class="fas fa-location-arrow"></i> @lang('site.Priority')
                    </div>
                    <div class="body-info">
                        {{ $itemsorder->priority }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>



</section>

@endsection


{{-- Custom scripts --}}
@section('scripts')

@endsection