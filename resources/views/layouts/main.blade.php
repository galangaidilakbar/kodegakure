<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="font-sans text-gray-900 antialiased">
        @include('layouts.top-header')

        <main class="bg-gray-50 py-0 lg:py-2.5">
            {{ $slot }}
        </main>

        @include('layouts.bottom-navigation')
    </div>

    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <script>
        $(document).ready(() => {
            $("#home").click(() => {
                window.location.href = `{{ route('index') }}`
            })

            $("#create").click(() => {
                window.location.href = `{{ route('posts.create') }}`
            })

            $("#lg_home").click(() => {
                window.location.href = `{{ route('index') }}`
            })

            $("#lg_create").click(() => {
                window.location.href = `{{ route('posts.create') }}`
            })

            $("#lg_github_profile").click(() => {
                window.location.href = `https://github.com/Galangaidil`
            })
        })
    </script>

    @yield('script')
</body>

</html>
