@php
$currentLanguage = app()->getLocale();
@endphp

@extends('dashboard-views.layouts.master', [
'parent' => 'organization',
'child' => '',
])

{{-- Custom Title --}}
@section('title')
    @lang('site.Organization-chart')
@endsection

{{-- Custom Styles --}}
@section('styles')
    <style>
        #chart_div,
        #chart_div * {
            direction: ltr !important;
            -webkit-touch-callout: none;
            /* iOS Safari */
            -webkit-user-select: none;
            /* Safari */
            -khtml-user-select: none;
            /* Konqueror HTML */
            -moz-user-select: none;
            /* Old versions of Firefox */
            -ms-user-select: none;
            /* Internet Explorer/Edge */
            user-select: none;
            /* Non-prefixed version, currently
                                                                                                                                                                  supported by Chrome, Edge, Opera and Firefox */
        }

        #chart_div {
            /* transform: scale(0.5);
                    transform-origin: 0 0; */
            width: 100%;
            zoom: 0.7;
        }

        #chart_div rect {
            fill: #61C9CC;
        }

        .edit-photo {
            background-color: #61C9CC !important;
        }

        .bg-ripple-container+img {
            border-radius: 0 !important;
        }

    </style>

    <style id="myStyles">
        .node.CEO rect {
            fill: #76BA3D !important;
        }

        .node.S rect {
            fill: #55C6CA !important;
        }

        .node.D rect {
            fill: #3DBB9F !important;
        }

        .node.P rect {
            fill: #329B5F !important;
        }

    </style>

@endsection

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <h1>@lang('site.Organization-chart')</h1>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.Home')</a></li>
                        <li class="breadcrumb-item active"> @lang('site.Organization-chart')</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content service-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div id="chart_div"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection
@section('scripts')

    <script src="{{ asset('plugins/orgchart/orgchart.js') }}"></script>

    <script>
        $('body').addClass('sidebar-collapse');

        function pdf(nodeId) {
            chart.exportPDF({
                filename: "EEC Organization Chart.pdf",
                header: 'EEC Organization Chart',
                footer: 'EEC Organization Chart. Page {current-page} of {total-pages}',
                expandChildren: true,
                nodeId: nodeId
            });
        }

        function png(nodeId) {
            chart.exportPNG({
                filename: "EEC Organization Chart.png",
                expandChildren: true,
                nodeId: nodeId
            });
        }

        function svg(nodeId) {
            chart.exportSVG({
                filename: "EEC Organization Chart.svg",
                expandChildren: true,
                nodeId: nodeId
            });
        }

        const exportLang = "@lang('site.Export')";

        var chart = new OrgChart(document.getElementById("chart_div"), {
            mouseScrool: OrgChart.action.none,
            menu: {
                export_pdf: {
                    text: exportLang + " PDF",
                    icon: OrgChart.icon.pdf(24, 24, "#7A7A7A"),
                    onClick: pdf
                },
                export_png: {
                    text: exportLang + " PNG",
                    icon: OrgChart.icon.png(24, 24, "#7A7A7A"),
                    onClick: png
                },
                export_svg: {
                    text: exportLang + " SVG",
                    icon: OrgChart.icon.svg(24, 24, "#7A7A7A"),
                    onClick: svg
                },
                csv: {
                    text: exportLang + " CSV"
                }
            },
            nodeMenu: {
                export_pdf: {
                    text: exportLang + " PDF",
                    icon: OrgChart.icon.pdf(24, 24, "#7A7A7A"),
                    onClick: pdf
                },
                export_png: {
                    text: exportLang + " PNG",
                    icon: OrgChart.icon.png(24, 24, "#7A7A7A"),
                    onClick: png
                },
                export_svg: {
                    text: exportLang + " SVG",
                    icon: OrgChart.icon.svg(24, 24, "#7A7A7A"),
                    onClick: svg
                },
            },
            nodeBinding: {
                field_0: JSON.parse(@json($nodes)).name,
                field_1: JSON.parse(@json($nodes)).responsibleEmployee,
                img_0: "img"
            },
        });

        let nodes = JSON.parse(@json($data));

        nodes.forEach(node => {
            node.tags = [node.title];
        });

        chart.on('exportstart', function(sender, args) {
            args.styles += document.getElementById('myStyles').outerHTML;
        });

        chart.load(nodes);
        $('input[title="Search"]').attr('placeholder', "@lang('site.Search')");
    </script>
@endsection
