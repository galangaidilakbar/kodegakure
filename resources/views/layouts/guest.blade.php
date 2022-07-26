<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('kodegakure-logo.svg') }}" type="image/x-icon">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <script src="{{ asset('js/splide.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('css/splide.min.css') }}">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div class="bg-gray-50 font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
