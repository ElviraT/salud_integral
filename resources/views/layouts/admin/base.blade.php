<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', App::getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="light"
    data-sidebar-size="lg" data-sidebar-image="none">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Kanakku provides clean Admin Templates for managing Sales, Payment, Invoice, Accounts and Expenses in HTML, Bootstrap 5, ReactJs, Angular, VueJs and Laravel.">
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
    <meta name="author" content="Ing. Elvira Terán">

    {{-- <meta property="og:url" content="https://kanakku.dreamguystech.com/"> --}}
    <meta property="og:title" content="{{ 'Unidad Medica Cadena de Favores Venezuela' }}">
    <meta property="og:description"
        content="Kanakku is a Sales, Invoices & Accounts Admin template for Accountant or Companies/Offices with various features for all your needs. Try Demo and Buy Now.">
    <meta property="og:image" content="{{ asset(Storage::url('logos/' . Session::get('logo'))) }}">
    <meta property="og:image:secure_url" content="{{ asset(Storage::url('logos/' . Session::get('favicon'))) }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">
    <title>{{ Session::get('name') }}</title>

    <link rel="shortcut icon" href="{{ asset(Storage::url('logos/' . Session::get('favicon'))) }}">

    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/scrollbar/scroll.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/stickynote/sticky.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/alertify/alertify.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/scrollbar/scroll.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/introjs.min.css" />
    <script src="{{ asset('assets/js/layout.js') }}"></script>
    @include('layouts.admin.css')
</head>

<body>

    <div class="main-wrapper">

        @include('layouts.admin.menu_superior')
        @include('layouts.admin.menu_izq')

        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.admin.setting')

    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/scrollbar/scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/scrollbar/custom-scroll.js') }}"></script>
    <script src="{{ asset('assets/js/theme-settings.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/intlTelInput/js/intlTelInput-jquery.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/custom-select.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/countup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/countup/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/countup/jquery.missofis-countdown.js') }}"></script>

    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/7.2.0/intro.min.js"></script>
    {!! Toastr::message() !!}

    @yield('js')
    @yield('modal')
    @yield('filtros')
    @include('layouts.admin.functions')
</body>

</html>
