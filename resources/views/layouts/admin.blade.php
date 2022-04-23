<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@section('title'){{ config('app.name', 'CitiesOfRussia') }}@show</title>

    <!-- Styles -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>

<body>

    <x-admin.header />

    <main class="admin-panel container">

        <div class="admin-panel__header">
            @yield('content-header')
        </div>

        @yield('content')

    </main>

    <script src="{{ asset('js/admin.js') }}"></script>

    @stack('js')

</body>

</html>
