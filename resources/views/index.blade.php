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

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    <!-- Navigation -->
    <div class="container">
        <div class="flex justify-between pt-2.5 px-4 lg:px-0">
            <a href="/" class="font-semibold text-2xl">{{config('app.name')}}</a>

            <div class="hidden">
                <a href="{{ route('posts.create') }}" class="hover:text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                    </svg>
                </a>
            </div>

            <div id="menu-toggle" class="hidden lg:hidden">
                <button type="button"
                        class="hover:bg-gray-100 rounded-full focus:outline-none focus:ring-4 focus:outline-none focus:ring-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="hidden mt-6 px-4" id="menu-item">
            <a href="#" class="block">menu</a>
            <a href="#" class="block">menu</a>
            <a href="#" class="block">menu</a>
            <a href="#" class="block">menu</a>
        </div>
    </div>

    <!-- Main -->
    <main class="container mt-6 max-w-lg">
        @foreach($posts as $post)
            <div class="kage-content relative lg:max-w-lg lg:border rounded-lg mb-3" id="post_{{ $post->id }}">
                <!-- Card Header -->
                <div x-data="{trigger: false}">
                    <div class="flex justify-between items-center px-4 py-1">
                        <div class="flex space-x-1 items-center">
                            <img class="w-14 h-14 rounded-full"
                                 src="{{ asset('MgLSVWnD_400x400.jpeg') }}"
                                 alt="Profile picture">
                            <p class="text-sm font-semibold">Galang Aidil Akbar
                                <span
                                    class="block text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
                            </p>
                        </div>
                        <button @click="trigger = ! trigger">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                 stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Dropdown menu -->
                    <div x-show="trigger" @click.outside="trigger = false" x-cloak
                         class="absolute z-10 top-14 right-4 bg-white divide-y divide-gray-100 rounded shadow w-44">
                        <div class="px-4 py-3 text-sm text-gray-900">
                            <div>Galang Aidil Akbar</div>
                            <div class="font-medium truncate">hokage@kodegakure.com</div>
                        </div>
                        <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownInformationButton">
                            <li>
                                <a href="{{ route('posts.edit', $post->id) }}"
                                   class="block px-4 py-2 hover:bg-gray-100">Edit</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                            </li>
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">Earnings</a>
                            </li>
                        </ul>
                        <div class="py-1">
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                        class="block w-full text-left px-4 py-2 text-sm text-red-700 hover:bg-red-100"
                                        onclick="return confirm('are u sure?')">Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Card image -->
                <div class="mt-3">
                    <img class="object-cover" src="{{ asset('storage/images/'.$post->filename) }}"
                         alt="{{ $post->filename }}">
                </div>

                <!-- Card Utilities -->
                <div class="flex justify-between items-center px-4 py-1 mt-3" x-data='{icons: {
                        fill: {
                            love: `<i class="bi bi-heart-fill text-red-500"></i>`,
                            bookmark: `<i class="bi bi-bookmark-fill text-blue-500"></i>`
                        },
                        outline: {
                            love: `<i class="bi bi-heart"></i>`,
                            bookmark: `<i class="bi bi-bookmark"></i>`
                        }
                    }, love: false, bookmark: false}'>
                    <div class="flex space-x-1 items-center">
                        <button @click="love = ! love">
                            <span x-show="! love" x-html="icons.outline.love"></span>
                            <span x-show="love" x-html="icons.fill.love"></span>
                        </button>
                        <button>
                            <i class="bi bi-chat"></i>
                        </button>
                        <button>
                            <i class="bi bi-share"></i>
                        </button>
                    </div>
                    <button @click="bookmark = ! bookmark">
                        <span x-show="! bookmark" x-html="icons.outline.bookmark"></span>
                        <span x-show="bookmark" x-html="icons.fill.bookmark"></span>
                    </button>
                </div>

                <!-- Card text -->
                <div class="px-4 my-3 w-56 flex space-x-1">
                    <p class="truncate">{{ $post->description }}</p>
                    <p class="text-gray-500 cursor-pointer" onclick="show('{{ route('posts.show', $post->id) }}')">
                        more</p>
                </div>
            </div>
        @endforeach
    </main>

    <!-- Bottom Menu -->
    <div class="block lg:hidden relative">
        <div class="fixed inset-x-0 bottom-0 bg-gray-900 h-20 text-white">
            <div class="container">
                <div class="flex justify-between items-center px-4 py-4 text-sm">
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span>Home</span>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <span>Search</span>
                    </div>
                    <div id="create"
                         class="cursor-pointer flex flex-col justify-center items-center hover:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                        </svg>
                        <span>Baru</span>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                        <span>Portfolio</span>
                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span>Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    $(document).ready(() => {
        $("#create").click(() => {
            window.location.href = "{{ route('posts.create') }}"
        })

        let open = false

        $("#menu-toggle").click(() => {
            if (open === false) {
                $("#menu-toggle button").html(icons.close)
                open = true
                $("#menu-item").slideDown()
            } else {
                $("#menu-toggle button").html(icons.menu)
                open = false
                $("#menu-item").slideUp()
            }
        })

        const icons = {
            close: '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" /></svg>',
            menu: '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>'
        }

        $(".kage-content").last().addClass('pb-20 lg:pb-0')
    })

    function show(id) {
        window.location.href = id
    }
</script>
</body>
</html>
