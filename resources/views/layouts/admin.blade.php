<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
          <!-- plugins:css -->
        <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <link rel="stylesheet" href="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
        <!-- endinject -->
        <link rel="shortcut icon" href="{{asset($appSetting->logo) ?? asset('assets/img/imagen_no_encontrada.jpg') }}" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <!--FONTS-->
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
        @livewireStyles
    </head>
    <body class="font-sans antialiased">

        <div class="container-scroller">
            @include('layouts.inc.admin.navbar')
            <div class="container-fluid page-body-wrapper">
                @include('layouts.inc.admin.sidebar')
                <div class="main-panel">
                    <div class="content-wrapper">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        
        <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>

        <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
        <script src="{{ asset('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
        
        <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
        <script src="{{ asset('admin/js/hoverable-collapse.js') }}"></script>
        <script src="{{ asset('admin/js/template.js') }}"></script>
        
        <!-- Custom js for this page-->
        <script src="{{ asset('admin/js/dashboard.js') }}"></script>
        <script src="{{ asset('admin/js/data-table.js') }}"></script>
        <script src="{{ asset('admin/js/jquery.dataTables.js') }}"></script>
        <script src="{{ asset('admin/js/dataTables.bootstrap4.js') }}"></script>
        <script src="{{ asset('admin/js/messages.js') }}"></script>
        <!-- End custom js for this page-->
        <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>

        @yield('scripts')
        @livewireScripts
        @stack('script')
    </body>
</html>