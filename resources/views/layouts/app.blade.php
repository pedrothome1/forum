<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fórum') }}</title>

    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('layouts.navbar')

        <main class="py-4 container">
            @yield('content')
        </main>

        <flash type="{{ session('type') }}" message="{{ session('status') }}"></flash>

        <div v-cloak>
            @section('modals')
                @include('modals.all')
            @show
        </div>
    </div>

    <script>
        window.App = {!! json_encode([
            'csrfToken' => csrf_token(),
            'user' => auth()->user(),
            'signedIn' => auth()->check()
        ]) !!};
    </script>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
