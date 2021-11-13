@php
// use Jenssegers\Date\Date;
$currentLanguage = app()->getLocale();
$name = 'name_' . $currentLanguage;
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'approval_timeline',
// 'child' => 'timeline',
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
            /* min-width: 300px; */
            max-width: 500px;
            margin: auto;
        }

        .stepline .item {
            /* font-size: 1em; */
            font-size: 0.5rem;
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
            top: calc(50% - 17.5px);
            border-radius: 50%;
            padding: 10px;
            background-color: #2b4c32;
            text-align: center;
            line-height: 16px;
            color: #fff;
            font-size: 1.8em;
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
                    @lang('site.Show') @lang('site.timeline')
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">@lang('site.timeline')</li>
                        <li class="breadcrumb-item active">@lang('site.Approval_cycles')</li>
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('site.Home')</a></li>

                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content" style="position: relative">

        <div class="container-fluid ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header show-approval parent">
                            <p class=" float-right"> @lang('site.created_at') : {{$created_at}} </p>
                            
                            <p class=" float-left"> @lang('site.creator') : {{ $user['name_' . $currentLanguage] }}  </p>
                           <p class="text-center" style="clear:both;"> {{ $cycleName->$name . " ( $codeOrId )" }} </p>
                        </div>
                        <div class="card-body text-center">
                            <main class="stepline">
                                @foreach ($timelines as $timeline)
                                    <div class="item">
                                        <h4>{{ $timeline->{'AS_' . $name} }}
                                            <p>({{ $timeline->{'U_' . $name} }})</p>
                                            @if ($timeline->approval_status == 'P')
                                                @lang('site.approval_status_pending')
                                                <i class="fas fa-spinner fa-pulse text-warning"></i>
                                            @elseif($timeline->approval_status ==
                                                'A')@lang('site.approval_status_approved')
                                                <i class="fas fa-check text-success"></i>
                                            @elseif($timeline->approval_status ==
                                                'RV')@lang('site.approval_status_reverted')
                                                <i class="fas fa-undo-alt text-danger"></i>
                                            @elseif($timeline->approval_status ==
                                                'RJ')@lang('site.approval_status_rejected')
                                                <i class="fas fa-times text-danger"></i>
                                            @endif
                                            <p>{{ Carbon\Carbon::parse($timeline->updated_at)->translatedFormat('d F Y || g:i:s A') }}
                                            </p>
                                            @if ($timeline->comment)
                                                <p class="alert alert-warning">{{ $timeline->comment }}</p>
                                            @endif

                                        </h4>
                                    </div>
                                @endforeach
                            </main>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection

{{-- Custom scripts --}}
@section('scripts')

@endsection
