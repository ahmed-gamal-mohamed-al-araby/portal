@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'supplier',
'child' => 'create',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Show') @lang('site.supplier')
@endsection

{{-- Custom Styles --}}
@section('styles')


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
                        <li class="breadcrumb-item active"> @lang('site.Show') @lang('site.supplier')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content profile-page" style="direction0: rtl !important; text-align0: right !important;">
        <div class="container-fluid">
            <div class="row flex-row-reverse0">
                <div class="col-md-3">
                    <!-- Supplier profile -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">

                            {{-- Supplier logo --}}
                            <div class="text-center">
                                @if ($supplier->logo)
                                    <img class="profile-user-img img-fluid img-circle"
                                        src={{ asset("uploaded-files/uploaded-files/supplier/logo/$supplier->logo") }}
                                        alt='@lang(' site.logo')'>
                                @else
                                    <img class="profile-user-img-not img-fluid img-circle"
                                        src="{{ asset('dist/img/user_profile.png') }}" alt='@lang(' site.logo')'>
                                @endif

                            </div>

                            {{-- Supplier logo --}}
                            <h3 class="profile-username text-center">
                                {{ $supplier->name }}
                            </h3>

                            <ul class="list-group list-group-unbordered mb-3">

                                {{-- Supplier phone --}}
                                <li class="list-group-item">
                                    <b>@lang('site.Phone')</b> <a class="float-right">{{ $supplier->phone }}</a>
                                </li>

                                {{-- Supplier mobile --}}
                                <li class="list-group-item">
                                    @if ($supplier->mobile)
                                        <b>@lang('site.Mobile')</b> <a class="float-right">{{ $supplier->mobile }}</a>
                                    @else
                                        <b>@lang('site.Mobile')</b> <a class="float-right"> <span class="text-danger">
                                                @lang('site.not_available')</span> </a>
                                    @endif
                                </li>

                                {{-- Supplier fax --}}
                                <li class="list-group-item">
                                    @if ($supplier->fax)
                                        <b>@lang('site.Fax')</b> <a class="float-right">{{ $supplier->fax }}</a>
                                    @else
                                        <b>@lang('site.Fax')</b> <a class="float-right"> <span class="text-danger">
                                                @lang('site.not_available')</span> </a>
                                    @endif
                                </li>

                                {{-- Supplier created date --}}
                                <li class="list-group-item">
                                    <b> @lang('site.Date')</b> <a class="float-right">
                                        {{ \Carbon\Carbon::parse($supplier->created_at)->format('d/m/Y') }}</a>
                                </li>

                            </ul>
                            <a href="{{ route('supplier.edit', $supplier->id) }}"
                                class="btn btn-warning btn-block"><b>@lang('site.Edit')</b></a>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">
                                        @lang('site.Details')</a></li>
                                <li class="nav-item"><a class="nav-link " href="#persons"
                                        data-toggle="tab">@lang('site.responsible_employees')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#supplier_familyNames"
                                        data-toggle="tab">@lang('site.supplier_family_names')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#accredite"
                                        data-toggle="tab">@lang('site.supplier_approval')</a></li>
                                <li class="nav-item"><a class="nav-link" href="#financial_data"
                                        data-toggle="tab">@lang('site.payment_method')</a></li>
                            </ul>
                        </div><!-- /.card-header -->

                        <div class="card-body">
                            <div class="tab-content">

                                {{-- Supplier basic data --}}
                                <div class="active tab-pane" id="activity">

                                    {{-- Email --}}
                                    <div class="supplier-info">
                                        <div class="header-info">
                                            <i class="fas fa-envelope-square"></i> @lang('site.Email')
                                        </div>
                                        <div class="body-info">
                                            @if ($supplier->email)
                                                {{ $supplier->email }}
                                            @else
                                                <span class="text-danger bg-transparent"> @lang('site.not_available')</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="supplier-info">
                                        <div class="header-info">
                                            <i class="fas fa-location-arrow"></i> @lang('site.Address')
                                        </div>
                                        <div class="body-info">
                                            {{ $supplier->address->getFullAddress()[$currentLanguage] }}
                                        </div>
                                    </div>

                                    {{-- google_map_link --}}
                                    <div class="supplier-info">
                                        <div class="header-info">
                                            <i class="fas fa-map-marked-alt"></i> @lang('site.google_map_link')
                                        </div>
                                        <div class="body-info">
                                            @if ($supplier->gmap_url)
                                                @lang('site.go_address') <a target="_blank"
                                                    href="{{ $supplier->gmap_url }}"> @lang('site.here')</a>
                                            @else
                                                <span class="text-danger bg-transparent"> @lang('site.not_available')</span>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- website --}}
                                    <div class="supplier-info">
                                        <div class="header-info">
                                            <i class="fab fa-chrome"></i> @lang('site.Website_link')
                                        </div>
                                        <div class="body-info">
                                            @if ($supplier->website_url)
                                                @lang('site.go_website') <a target="_blank"
                                                    href="{{ $supplier->website_url }}"> @lang('site.here')</a>
                                            @else
                                                <span class="text-danger bg-transparent"> @lang('site.not_available')</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- Responsible Persons --}}
                                <div class="tab-pane" id="persons">

                                    <div class="timeline timeline-inverse person-info">
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                <i class="fas fa-users"></i> @lang('site.responsible_employees_person')
                                                ({{ count($supplierData['personSuppliers']) }})
                                            </span>
                                        </div>

                                        {{-- Supplier responsible persons --}}
                                        @foreach ($supplierData['personSuppliers'] as $personSupplier)
                                            <div>
                                                <i class="fas fa-user bg-warning"></i>
                                                <div class="timeline-item">
                                                    <h3 class="timeline-header"> {{ $personSupplier->name }} </h3>
                                                    <div class="timeline-body body-info">

                                                        <div class="persons">
                                                            <p> <span class="person-info">@lang('site.job') :</span>
                                                                {{ $personSupplier->job }} </p>
                                                            <p> <span class="person-info ">@lang('site.Mobile') :</span>
                                                                {{ $personSupplier->mobile }} </p>
                                                            <p> <span class="person-info"> @lang('site.whatsapp')
                                                                    :</span>
                                                                @if ($personSupplier->whatsapp)
                                                                    {{ $personSupplier->whatsapp }} <a target="_blank"
                                                                        href="https://api.whatsapp.com/send?phone={{ $personSupplier->whatsapp }}"><i
                                                                            class="fab fa-whatsapp"></i></a>
                                                                @else
                                                                    <span class="text-danger">
                                                                        @lang('site.not_available')</span>
                                                                @endif
                                                            </p>
                                                            <p> <span class="person-info">@lang('site.email') :</span>
                                                                @if ($personSupplier->email)
                                                                    {{ $personSupplier->email }}
                                                                @else
                                                                    <span class="text-danger">
                                                                        @lang('site.not_available')</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- Note --}}
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                @lang('site.Note')
                                            </span>
                                        </div>

                                        <div>
                                            <i class="fas fa-clipboard bg-success"></i>
                                            <div class="timeline-item">
                                                <div class="timeline-body">
                                                    <ul class="product-item">
                                                        <li> <span class="profile_type_service">
                                                                @if ($supplier->person_note)
                                                                {{ $supplier->person_note }} @else
                                                                    <span class="text-danger">
                                                                        @lang('site.not_available')</span>
                                                                @endif
                                                            </span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Responsible FamilyNames --}}
                                <div class="tab-pane" id="supplier_familyNames">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <!-- timeline time label -->
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                @lang('site.family_names')
                                                ( {{ $supplierData['familyNamesCount'] }} )
                                            </span>
                                        </div>

                                        @foreach ($supplierData['subGroupWithSupplierFamilyNames_id'] as $subGroup_id => $subGroupWithSupplierFamilyName_id)
                                            <div>
                                                <i class="fas fa-tools bg-warning"></i>
                                                <div class="timeline-item">
                                                    <h3 class="timeline-header">
                                                        {{ $supplierData['subGroups'][$subGroup_id][$currentLanguage] }}
                                                    </h3>
                                                    <div class="timeline-body">
                                                        @foreach ($supplierData['subGroupWithItsFamilyNames'][$subGroup_id][0] as $familyName)
                                                            @if (in_array($familyName['id'], $supplierData['subGroupWithSupplierFamilyNames_id'][$subGroup_id]))
                                                                <ul class="product-item">
                                                                    <li> <span class="profile_type_service">
                                                                            {{ $familyName['name_' . $currentLanguage] }}</span>
                                                                    </li>
                                                                </ul>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- Note --}}
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                @lang('site.Note')
                                            </span>
                                        </div>

                                        <div>
                                            <i class="fas fa-clipboard bg-success"></i>
                                            <div class="timeline-item">
                                                <div class="timeline-body">
                                                    <ul class="product-item">
                                                        <li> <span class="profile_type_service">
                                                                @if ($supplier->family_name_note)
                                                                {{ $supplier->family_name_note }} @else
                                                                    <span class="text-danger">
                                                                        @lang('site.not_available')</span>
                                                                @endif
                                                            </span></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Required file Supplier --}}
                                <div class="tab-pane" id="accredite">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                @lang('site.supplier_approval') ( 4 )
                                            </span>
                                        </div>

                                        {{-- tax id number --}}
                                        <div>
                                            <i class="fas fa-file-pdf bg-gradient-danger"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"> @lang('site.tax_id_number_only')</h3>
                                                <div class="timeline-body">
                                                    <a class="btn btn-success mb-2" style="font-size: 12px"
                                                        href="{{ asset("uploaded-files/supplier/tax_id_number_file/$supplier->tax_id_number_file") }}"
                                                        target="_blank">@lang('site.Show') @lang('site.File')
                                                        @lang('site.tax_id_number_only')</a>
                                                    <p> <span class="text-bold">@lang('site.tax_id_number_only')
                                                            :</span>
                                                        {{ $supplier->tax_id_number }} </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Commercial registeration number --}}
                                        <div>
                                            <i class="fas fa-file-pdf bg-gradient-danger"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    @lang('site.commercial_registeration_number_only')</h3>
                                                <div class="timeline-body">
                                                    <a class="btn btn-success mb-2" style="font-size: 12px"
                                                        href="{{ asset("uploaded-files/supplier/commercial_registeration_number_file/$supplier->commercial_registeration_number_file") }}"
                                                        target="_blank">@lang('site.Show') @lang('site.File')
                                                        @lang('site.commercial_registeration_number_only')</a>
                                                    <p> <span
                                                            class="text-bold">@lang('site.commercial_registeration_number_only')
                                                            :</span> {{ $supplier->commercial_registeration_number }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Value add registeration number --}}
                                        <div>
                                            <i class="fas fa-file-pdf bg-gradient-danger"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    @lang('site.value_add_registeration_number_only')</h3>
                                                <div class="timeline-body">
                                                    @if (file_exists(
            public_path(" uploaded-files/supplier/value_add_registeration_number_file/$supplier->
                                                        value_add_registeration_number_file"),
                                                        ))
                                                        <a class="btn btn-success mb-2" style="font-size: 12px"
                                                            href="{{ asset("uploaded-files/supplier/value_add_registeration_number_file/$supplier->value_add_registeration_number_file") }}"
                                                            target="_blank">@lang('site.Show') @lang('site.File')
                                                            @lang('site.value_add_registeration_number_only')</a>
                                                    @else
                                                        <span class="text-bold">@lang('site.File')
                                                            @lang('site.value_add_registeration_number_only') :</span>
                                                        <span class="text-danger"> @lang('site.not_available')</span>
                                                    @endif
                                                    <p> <span
                                                            class="text-bold">@lang('site.commercial_registeration_number_only')
                                                            :</span>
                                                        @if ($supplier->value_add_registeration_number)
                                                            {{ $supplier->value_add_registeration_number }}
                                                        @else
                                                            <span class="text-danger">
                                                                @lang('site.not_available')</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Tax file number file --}}
                                        <div>
                                            <i class="fas fa-file-pdf bg-gradient-danger"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    @lang('site.tax_file_number')</h3>
                                                <div class="timeline-body">
                                                    @if (file_exists(
            public_path(" uploaded-files/supplier/tax_file_number_file/$supplier->tax_file_number_file"),
                                                        ))
                                                        <a class="btn btn-success mb-2" style="font-size: 12px"
                                                            href="{{ asset("uploaded-files/supplier/tax_file_number_file/$supplier->tax_file_number_file") }}"
                                                            target="_blank">@lang('site.Show')
                                                            @lang('site.tax_file_number')</a>
                                                    @else
                                                        <span class="text-bold"> @lang('site.File')
                                                            @lang('site.tax_file_number') :</span> <span
                                                            class="text-danger"> @lang('site.not_available')</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Note --}}
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                @lang('site.Note')
                                            </span>
                                        </div>

                                        <div>
                                            <i class="fas fa-clipboard bg-success"></i>
                                            <div class="timeline-item">
                                                <div class="timeline-body">
                                                    <ul class="product-item">
                                                        <li>
                                                            @if ($supplier->accredite_note)
                                                                <span class="profile_type_service">
                                                                    {{ $supplier->accredite_note }}</span>
                                                            @else
                                                                <span class="text-danger">
                                                                    @lang('site.not_available')</span>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                {{-- Supplier financial entity data (payment method) --}}
                                <div class="tab-pane" id="financial_data">
                                    <!-- The timeline -->
                                    <div class="timeline timeline-inverse">
                                        <div class="time-label">
                                            <span class="bg-danger">
                                                @lang('site.payment_method') ( {{ $supplierData['paymentCount'] }} )
                                            </span>
                                        </div>

                                        {{-- Cashe option --}}
                                        <div>
                                            <i class="fas fa-file-pdf bg-gradient-danger"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"> @lang('site.cash')</h3>
                                                <div class="timeline-body">
                                                    @if ($supplier->cash)
                                                        <span class="d-block text-success"> @lang('site.available') <i
                                                                class="fas fa-check"></i></span>
                                                    @else
                                                        <span class="d-block text-danger"> @lang('site.not_available') <i
                                                                class="fas fa-times"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- cheque --}}
                                        <div>
                                            <i class="fas fa-file-pdf bg-gradient-danger"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header"> @lang('site.cheque')</h3>
                                                <div class="timeline-body">
                                                    @if ($supplierData['supplierCheque'])
                                                        <span class="d-block"> <span
                                                                class="text-bold">@lang('site.name_on_cheque') :
                                                            </span>{{ $supplierData['supplierCheque']->name_on_cheque }}</span>
                                                    @else
                                                        <span class="d-block text-danger"> @lang('site.not_available') <i
                                                                class="fas fa-times"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        {{-- bank transfer --}}
                                        <div>
                                            <i class="fas fa-file-pdf bg-gradient-danger"></i>
                                            <div class="timeline-item">
                                                <h3 class="timeline-header">
                                                    @lang('site.bank_transfer')</h3>
                                                <div class="timeline-body">
                                                    @if ($supplierData['supplierBankTransfer'])

                                                        <span class="d-block"> <span
                                                                class="text-bold">@lang('site.bank_name') :
                                                            </span>{{ $supplierData['supplierBankTransfer']->bank_name }}</span>

                                                        <span class="d-block"> <span
                                                                class="text-bold">@lang('site.bank_account_number') :
                                                            </span>{{ $supplierData['supplierBankTransfer']->bank_account_number }}</span>

                                                        <span class="d-block"> <span
                                                                class="text-bold">@lang('site.bank_branch') :
                                                            </span>{{ $supplierData['supplierBankTransfer']->bank_branch }}</span>
                                                    @else
                                                        <span class="d-block text-danger"> @lang('site.not_available') <i
                                                                class="fas fa-times"></i></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <!-- /.tab-pane -->

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>



@endsection

{{-- Custom scripts --}}
@section('scripts')

@endsection
