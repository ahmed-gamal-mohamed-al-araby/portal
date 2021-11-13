@php
$parent = $parent ?? null;
$child = $child ?? null;
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-success">
    <div class="overlay"></div>
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link navbar-success">
        <img src="{{ asset('dist/img/favicon-white.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3 m-0 px-2" style="opacity: .8">
        <span class="brand-text font-weight-light" style="z-index: 10000">EEC <sub> Group</sub></span>
    </a>

    <!-- Sidebar -->
    <div
        class="sidebar os-theme-light os-host-overflow-y os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-transition">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-child-indent" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link  {{ $parent == 'dashboard' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>@lang('site.Dashboard')</p>
                    </a>
                </li>

                {{-- Organization chart --}}
                <li class="nav-item">
                    <a href="{{ route('organization.chart.index') }}"
                        class="nav-link {{ $parent == 'organization' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>@lang('site.Organization-chart')</p>
                    </a>
                </li>

                <li class="nav-header">@lang('site.Approvals')</li>

                {{-- Approval requests waiting--}}
                <li class="nav-item">
                    <a href="{{ route('approvals.index') }}"
                        class="nav-link {{ $parent == 'approval_index' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-spinner fa-pulse"></i>
                        <p>@lang('site.Approval_requests')</p>
                    </a>
                </li>

                {{-- Approval cycles --}}
                <li class="nav-item">
                    <a href="{{ route('approvals.show_all_cycles') }}"
                        class="nav-link {{ $parent == 'approval_show_all_cycles' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-check"></i>
                        <p>@lang('site.Approval_cycles')</p>
                    </a>
                </li>

                {{-- Approval requests timeline --}}
                <li class="nav-item">
                    <a href="{{ route('approvals.show_all_approval_requests_timeline') }}"
                        class="nav-link {{ $parent == 'approval_requests_timeline' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-stream"></i>
                        <p>@lang('site.timeline')</p>
                    </a>
                </li>

                <li class="nav-header">@lang('site.Classification')</li>

                {{-- Sector --}}
                <li class="nav-item has-treeview {{ $parent == 'sector' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ $parent == 'sector' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-border-all"></i>
                        <p>
                            @lang('site.Sectors')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sector.index') }}" class="nav-link @if ($parent == 'sector' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.sectors')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sector.create') }}" class="nav-link @if ($parent == 'sector' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Department --}}
                <li class="nav-item has-treeview {{ $parent == 'department' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'department' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sitemap"></i>
                        <p>
                            @lang('site.Departments')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('department.index') }}" class="nav-link @if ($parent == 'department' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.departments')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('department.create') }}" class="nav-link @if ($parent == 'department' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Project --}}
                <li class="nav-item has-treeview {{ $parent == 'project' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'project' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hotel"></i>
                        <p>
                            @lang('site.Projects')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('project.index') }}" class="nav-link @if ($parent == 'project' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.projects')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('project.create') }}" class="nav-link @if ($parent == 'project' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Sites --}}
                <li class="nav-item has-treeview {{ $parent == 'site' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'site' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-hotel"></i>
                        <p>
                            @lang('site.Sites')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('site.index') }}" class="nav-link @if ($parent == 'site' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.sites')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('site.create') }}" class="nav-link @if ($parent == 'site' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-header">@lang('site.the_jobs')</li>

                {{-- Job code --}}
                <li class="nav-item has-treeview {{ $parent == 'job-code' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'job-code' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-id-card-alt"></i>
                        <p>
                            @lang('site.Job_codes')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('job-code.index') }}" class="nav-link @if ($parent == 'job-code' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.job_codes')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('job-code.create') }}" class="nav-link @if ($parent == 'job-code' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Job grade --}}
                <li class="nav-item has-treeview {{ $parent == 'job-grade' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'job-grade' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-sort-amount-up-alt"></i>
                        <p>
                            @lang('site.Job_grades')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('job-grade.index') }}" class="nav-link @if ($parent == 'job-grade' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.job_grades')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('job-grade.create') }}" class="nav-link @if ($parent == 'job-grade' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Job name --}}
                <li class="nav-item has-treeview {{ $parent == 'job-name' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'job-name' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            @lang('site.Job_names')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('job-name.index') }}" class="nav-link @if ($parent == 'job-name' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.job_names')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('job-name.create') }}" class="nav-link @if ($parent == 'job-name' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-header">@lang('site.location')</li>

                {{-- Country --}}
                <li class="nav-item has-treeview {{ $parent == 'country' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'country' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-flag"></i>
                        <p>
                            @lang('site.Countries')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('country.index') }}" class="nav-link @if ($parent == 'country' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.countries')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('country.create') }}" class="nav-link @if ($parent == 'country' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Governorate --}}
                <li class="nav-item has-treeview {{ $parent == 'governorate' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'governorate' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-city "></i>
                        <p>
                            @lang('site.Governorates')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('governorate.index') }}" class="nav-link @if ($parent == 'governorate' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.governorates')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('governorate.create') }}" class="nav-link @if ($parent == 'governorate' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-header">@lang('site.purchasing_system')</li>

                {{-- Group --}}
                <li class="nav-item has-treeview {{ $parent == 'group' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'group' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-dice-d6"></i>
                        <p>
                            @lang('site.Groups')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('group.index') }}" class="nav-link @if ($parent == 'group' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.groups')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('group.create') }}" class="nav-link @if ($parent == 'group' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- SubGroup --}}
                <li class="nav-item has-treeview {{ $parent == 'sub-group' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'sub-group' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            @lang('site.Sub_groups')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('sub-group.index') }}" class="nav-link @if ($parent == 'sub-group' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.sub_groups')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sub-group.create') }}" class="nav-link @if ($parent == 'sub-group' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Family name --}}
                <li class="nav-item has-treeview {{ $parent == 'family-name' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'family-name' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>
                            @lang('site.Family_names')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('family-name.index') }}" class="nav-link @if ($parent == 'family-name' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.family_names')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('family-name.create') }}" class="nav-link @if ($parent == 'family-name' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Supplier --}}
                <li class="nav-item has-treeview {{ $parent == 'supplier' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'supplier' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            @lang('site.Suppliers')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('supplier.index') }}" class="nav-link @if (request()->routeIs('supplier.index')) {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.suppliers')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supplier.search') }}" class="nav-link {{ (request()->routeIs('supplier.search')) ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p> @lang('site.search.Suppliers')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('supplier.create') }}" class="nav-link @if (request()->routeIs('supplier.create')) {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>

                {{-- Purchase request --}}
                <li class="nav-item has-treeview {{ $parent == 'purchase-request' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'purchase-request' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            @lang('site.Purchase_requests')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('purchase-request.index') }}"
                                class="nav-link @if ($parent == 'purchase-request' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.purchase_requests')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('purchase-request.create') }}"
                                class="nav-link @if ($parent == 'purchase-request' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-header">@lang('site.Employees')</li>

                {{-- Employee --}}
                <li class="nav-item has-treeview {{ $parent == 'employee' ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link  {{ $parent == 'employee' ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            @lang('site.Employees')
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('employee.index') }}" class="nav-link @if ($parent == 'employee' && $child == 'index') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.All') @lang('site.employees')</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employee.create') }}" class="nav-link @if ($parent == 'employee' && $child == 'create') {{ 'active' }} @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>@lang('site.Add')</p>
                            </a>
                        </li>

                    </ul>
                </li>
                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tree"></i>
                        <p>
                            UI Elements
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/UI/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/icons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Icons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/buttons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Buttons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/sliders.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sliders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/modals.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Modals & Alerts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/navbar.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Navbar & Tabs</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/timeline.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Timeline</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/UI/ribbons.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ribbons</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Forms
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>General Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Advanced Elements</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Editors</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Tables
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/tables/simple.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Simple Tables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/data.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>DataTables</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/tables/jsgrid.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>jsGrid</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="pages/calendar.html" class="nav-link">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Calendar
                            <span class="badge badge-info right">2</span>
                        </p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="pages/gallery.html" class="nav-link">
                        <i class="nav-icon far fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/mailbox/mailbox.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/compose.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/mailbox/read-mail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Read</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/invoice.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Invoice</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/profile.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/e_commerce.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>E-commerce</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/projects.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Projects</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project_add.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Add</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project_edit.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Edit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/project_detail.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Project Detail</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/contacts.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Contacts</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-plus-square"></i>
                        <p>
                            Extras
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/examples/login.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Login</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/register.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Register</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/lockscreen.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lockscreen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/legacy-user-menu.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Legacy User Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/language-menu.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Language Menu</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/404.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Error 404</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/500.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Error 500</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/examples/blank.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Blank Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="starter.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Starter Page</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-header">MISCELLANEOUS</li> --}}

                {{-- <li class="nav-item">
                    <a href="https://adminlte.io/docs/3.0" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>Documentation</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-header">LABELS</li> --}}

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-danger"></i>
                        <p class="text">Important</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-warning"></i>
                        <p>Warning</p>
                    </a>
                </li> --}}

                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Informational</p>
                    </a>
                </li> --}}

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
