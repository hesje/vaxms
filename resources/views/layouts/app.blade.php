<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Home') - {{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.x/dist/alpine.min.js" defer></script>

    @livewireStyles
</head>

@include('layouts.nav')

<body class="bg-fixed" style="background: url('plus.svg');">

    <div class="container mx-auto px-5">
        @yield('content')
        @isset($slot)
            {{ $slot }}
        @endisset
    </div>

    @livewireScripts
    @stack('scripts')
    <script src="{{ asset('js/app.js') }}"></script>

    @if (app()->environment() =='local')
        <script>
            let logComponentsData = function () {
                window.livewire.components.components().forEach(component => {
                    console.log("%cComponent: " + component.name, "font-weight:bold");
                    console.log(component.data);
                });
            };
            document.addEventListener("livewire:load", function(event) {
                logComponentsData();

                window.livewire.hook('message.processed', () => {
                    logComponentsData();
                });
            });
        </script>
    @endif
</body>
</html>
