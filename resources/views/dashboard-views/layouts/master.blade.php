@include('dashboard-views.includes.header')

<body class="hold-transition sidebar-mini layout-fixed accent-success">

    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/favicon.png') }}" alt="AdminLTELogo" height="60"
                width="60">
            <span>EEC <sub> Group</sub></span>
        </div>

        <!-- Navbar -->
        @include('dashboard-views.includes.navbar')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('dashboard-views.includes.sidebar')
        <!-- /.Main Sidebar Container -->

        <!-- Page content -->
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            @yield('content')
            <!-- /.content -->
            {{-- Start loader --}}
            <div class="loader-container" style="display: none">
                <div class="bouncing-loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            {{-- End loader --}}

        </div>
        <!-- /.content-wrapper -->

        <!-- Footer -->
        @include('dashboard-views.includes.footer')
        <!-- /.footer -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- Scripts -->
    @include('dashboard-views.includes.script')
    <!-- Custom scripts -->
    @yield('scripts')
</body>

</html>
