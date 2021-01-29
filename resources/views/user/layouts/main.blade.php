<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Talkmaze- @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Custom Files -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/steps.css')}}" />

     <link href="{{ asset('dashboard/dist/css/pignose.calendar.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/slick/slick-theme.css') }}">

    <!-- fontawesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">

    <!-- jssocials -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jssocials.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jssocials-theme-flat.css') }}">
    <link href="{{ asset('admin/css/myvalidate.css') }}" rel="stylesheet" type="text/css">
</head>
<body>

    @yield('content')

</body>
</html>
<!-- <script src="{{ asset('js/all.js') }}"></script> -->
