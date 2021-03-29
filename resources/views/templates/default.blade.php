<!doctype html>
<html lang="ru">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>Социальная сеть | {{ config('app.name') }}</title>
</head>
<body>
    @include('templates.part.navbar')

    <div class="container content">

        @include('templates.part.alerts')

        @yield('content')

        <hr class="row">
    </div>

    <footer class="container my-3 d-flex justify-content-between">
        <div>
            <a href="{{ route('home') }}"> {{ config('app.name') }}</a>
            © {{ date('Y') }}
        </div>
        <div>
            <a href="#">О {{ config('app.name') }}</a>
            <a href="#">Правила</a>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
            $('[data-toggle="popover"]').popover()
        })
    </script>

    @stack('scripts')

</body>
</html>
