<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('favicon.ico') }}" rel="shortcut icon">
    <title>{{ config('app.name', 'FriendzPH') }}</title>

    {{-- Styles --}}
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.min.css') }}">
    <link href="{{ asset('vendor/material-icons/css/mi.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('vendor/mdbootstrap/css/mdb.css')}}" />
    @stack('css')
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="flex-center">
        @yield('content')
    </div>

    {{-- Scripts --}}
    <script type="text/javascript" src="{{ asset('vendor/jquery/js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/popper.js/js/popper.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ asset('vendor/mdbootstrap/js/mdb.js')}}"></script>   
    <script type=text/javascript" src="{{ asset('/js/app.js') }}"></script>
    @stack('js')
</body>
</html>
