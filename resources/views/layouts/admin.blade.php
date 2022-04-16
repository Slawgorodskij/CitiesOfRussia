<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title'){{ config('app.name', 'CitiesOfRussia') }}@show</title>

    <!-- Scripts -->


    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>

    <x-admin.header />

    @yield('content')

</body>

</html>
