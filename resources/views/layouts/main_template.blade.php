<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.head')
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef" />
    {{-- <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}"> --}}
    <link rel="manifest" href="{{ asset('/manifest.json') }}">
</head>

<body>
    @include('includes.menu')
    <div style="padding-top:60px">
        @yield('content')
    </div>
    @include('includes.foot')

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if ("serviceWorker" in navigator) {
            // Register a service worker hosted at the root of the
            // site using the default scope.
            navigator.serviceWorker.register("/sw.js").then(
                (registration) => {
                    console.log("Service worker registration succeeded:", registration);
                },
                (error) => {
                    console.error(`Service worker registration failed: ${error}`);
                },
            );
        } else {
            console.error("Service workers are not supported.");
        }
    </script>
</body>

</html>
