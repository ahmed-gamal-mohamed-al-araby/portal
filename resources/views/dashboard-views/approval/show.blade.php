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
                        <li class="breadcrumb-item"><a href="">@lang('site.Approval_cycles')</a></li>
                        <li class="breadcrumb-item active">{{ $approvalCycle['name_' . $currentLanguage] }}</li>

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
                            <h5 class="mb-0">{{ $approvalCycle['name_' . $currentLanguage] }}</h5>
                            {{-- <a href="" class="btn btn-success">Edit</a> --}}
                        </div>
                        <div class="card-body text-center">
                            <main class="stepline">
                                @foreach ($approvalCycle['steps'] as $step)
                                    <div class="item">
                                        <h4>{{ $step->$name }}</h4>
                                        {{-- @foreach ($steps->users as $user)
                                            <span>{{ $user->name }}</span>
                                        @endforeach --}}
                                    </div>
                                @endforeach

                                {{-- @for ($i = 0; $i < 5; $i++)
                                    <div class="item">
                                        <h4> Step name {{ $i + 1 }}</h4>
                                        @for ($j = 0; $j < 5; $j++)
                                            <span> User name {{ $i * $j }}</span>
                                        @endfor
                                    </div>
                                @endfor --}}

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
