<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Portofolio Galang Aidil Akbar | Junior Programmer di Phoenix">

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
        const token = window.localStorage.getItem('tokens');

        if (token === null)
        {
            $("#lg_logout").hide()
            $("#logout").hide()
        } else {
            $("#lg_login").hide()
            $("#login").hide()
        }

        $(document).ready(() => {

            // Responsive mobile menu

            $("#home").click(() => {
                window.location.href = `{{ route('index') }}`
            })

            $("#create").click(() => {
                window.location.href = `{{ route('create_post') }}`
            })

            $("#login").click(() => {
                window.location.href = `{{ route('login') }}`
            })

            $("#logout").click(() => {
                logout()
            })

            // Desktop menu

            $("#lg_home").click(() => {
                window.location.href = `{{ route('index') }}`
            })

            $("#lg_create").click(() => {
                window.location.href = `{{ route('create_post') }}`
            })

            $("#lg_github_profile").click(() => {
                window.location.href = `https://github.com/Galangaidil`
            })

            $("#lg_login").click(() => {
                window.location.href = `{{ route('login') }}`
            })

            $("#lg_logout").click(() => {
                logout()
            })
        })

        function logout()
        {
            let logout = `{{ route('logout') }}`

            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

            axios.post(logout)
                .then(response => {
                    $("#lg_logout").hide()
                    window.localStorage.removeItem('tokens');
                    window.localStorage.removeItem('user');
                    window.location.href = `{{ route('index') }}`
                })
                .catch(error => {
                    console.log(error.response)
                })
        }
    </script>

    @yield('script')
</body>

</html>
