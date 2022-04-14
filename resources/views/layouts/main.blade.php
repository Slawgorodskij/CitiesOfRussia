<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@section('title'){{ config('app.name', 'CitiesOfRussia') }}@show</title>
</head>

<body>
    <x-header />

    @yield('content')

    <x-footer />
</body>

</html>
