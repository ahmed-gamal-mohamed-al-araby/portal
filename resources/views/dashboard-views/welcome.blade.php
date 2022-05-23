@extends('dashboard-views.layouts.master')

{{-- Page Title --}}
@section('title')
    @lang('site.Dashboard')
@endsection
{{-- End Page Title --}}

{{-- Custom styles --}}
@section('styles')

@endsection
{{-- End Custom styles --}}

{{-- Page content --}}
@section('content')

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">@lang('site.Dashboard')</h1>
            </div><!-- /.col -->
  
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    {{-- <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li> --}}
                    <li class="breadcrumb-item active">@lang('site.Dashboard')</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            {{-- Sectors --}}
            @if (session('success'))
<div class="col-sm-12">
    <div class="alert  alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

@if (session('error'))
<div class="col-sm-12">
    <div class="alert  alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif
            <div class="col-lg-3 col-6">
                <!-- small box -->
   
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{ $count['sectors'] }}</h3>

                        <p>@lang('site.Sectors')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-border-all"></i>
                    </div>
                    <a href="{{ route('sector.index') }}" class="small-box-footer">@lang('site.More_info') <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{ $count['departments'] }}</h3>

                        <p>@lang('site.Departments')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-sitemap"></i>
                    </div>
                    <a href="{{ route('department.index') }}" class="small-box-footer">@lang('site.More_info') <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{ $count['projects'] }}</h3>

                        <p>@lang('site.Projects')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-hotel"></i>
                    </div>
                    <a href="{{ route('project.index') }}" class="small-box-footer">@lang('site.More_info') <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{ $count['sites'] }}</h3>

                        <p>@lang('site.Sites')</p>
                    </div>
                    <div class="icon">
                        <i class="nav-icon fas fa-hotel"></i>
                    </div>
                    <a href="{{ route('site.index') }}" class="small-box-footer">@lang('site.More_info') <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@endsection
{{-- End Page content --}}


{{-- Custom scripts --}}
@section('scripts')

@endsection
{{-- End Custom scripts --}}
