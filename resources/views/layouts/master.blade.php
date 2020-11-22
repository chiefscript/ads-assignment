<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KENR001788') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/vendor/mdbootstrap/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="{{ asset('css/vendor/mdbootstrap/mdb.min.css') }}" rel="stylesheet">
    <!-- Datatables -->
    <link href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('css/vendor/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/vendor/select2/select2-bootstrap.min.css') }}" rel="stylesheet">
    <!-- Select2 -->
    <link href="{{ asset('css/vendor/sweetalert/sweetalert.css') }}" rel="stylesheet">
    <!-- Custom -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Scripts -->
</head>
<body>
    <!-- Page Content -->
    <div class="container-fluid mt-lg-3">
        @yield('content')
    </div>

    <!-- JQuery -->
    <script type="text/javascript" src="{{ asset('js/vendor/mdbootstrap/jquery.min.js') }}"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="{{ asset('js/vendor/mdbootstrap/popper.min.js') }}"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/vendor/mdbootstrap/bootstrap.min.js') }}"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="{{ asset('js/vendor/mdbootstrap/mdb.min.js') }}"></script>
    <!--Datatables -->
    <script type="text/javascript" src="{{ asset('js/vendor/mdbootstrap/addons/datatables2.min.js') }}"></script>
    <!--Select2 -->
    <script type="text/javascript" src="{{ asset('js/vendor/select2/select2.min.js') }}"></script>
    <!--SweetAlert -->
    <script type="text/javascript" src="{{ asset('js/vendor/sweetalert/sweetalert.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
