<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('analytics.google')
        <!-- Meta Information -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Mychal Calderon's Website and Blog">
        <meta name="keywords" content="Portfolio,Web Design,Web Development,Laravel">
        @yield('meta-data')

        <title>@yield('title', config('app.name'))</title>

        <link rel="icon" type="image/x-icon" href="favicon.ico">
        <link rel="icon" type="image/png" href="favicon.png">

        <!-- Fonts -->
        <link href='https://fonts.googleapis.com/css?family=Quicksand:400,700' rel='stylesheet' type='text/css'>
        <script defer src="https://pro.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-+1nLPoB0gaUktsZJP+ycZectl3GX7wP8Xf2PE/JHrb7X1u7Emm+v7wJMbAcPr8Ge" crossorigin="anonymous"></script>

        <!-- CSS -->
        <link href="/css/app.css" rel="stylesheet">

        @stack('head', '')

        <!-- Styles -->
    </head>
    <body class="@yield('body-class', '')">
        @include('nav')

        @yield('content')

        {{-- <script src="/js/app.js"></script> --}}
        @stack('scripts', '')

    </body>
</html>
