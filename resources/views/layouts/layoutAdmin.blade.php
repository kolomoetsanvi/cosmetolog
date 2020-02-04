<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

{{--    <link href={{ asset("assets/site/Bootstrap/styles/bootstrap.min.css") }} rel="stylesheet" />--}}
    <script src={{ asset("assets/site/Bootstrap/js/jquery-1.11.1.min.js") }}></script>
    <script src={{ asset("assets/site/Bootstrap/js/bootstrap.min.js") }}></script>
    <link href={{ asset("assets/site/css/adminStyleSheet.css") }} rel="stylesheet" />
    <link href={{ asset("assets/site/css/adminColorStyle.css") }} rel="stylesheet" />

    <script src="{{ asset("assets/site/js/ckeditor5/ckeditor.js") }}"></script>
    <script src="{{ asset("assets/site/js/bootstrap-filestyle.min.js") }} "></script>

    <title>{{$title}}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>


</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  Косметолог in your city
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @yield('menu')

            </div>
        </nav>




        <main class="py-4">
            @yield('content')
        </main>



    </div>
</body>
</html>









