<div class="bg-white lg:border-b lg:border-gray-200">
    <div class="container mx-auto">
        <div class="max-w-4xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ route('index') }}" class="font-semibold text-2xl">{{ config('app.name') }}</a>

                <div class="hidden lg:block flex-1">
                    <form class="max-w-xs mx-auto">
                        <label class="relative block">
                            <span class="sr-only">Search</span>
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-gray-400"
                                                 viewBox="0 0 20 20" fill="currentColor">
                                              <path fill-rule="evenodd"
                                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                                    clip-rule="evenodd"/>
                                            </svg>
                                        </span>
                            <input
                                class="placeholder:text-gray-400 block bg-gray-100 w-full border-none rounded-md py-2 pl-10 pr-3 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-blue-500 focus:ring-2 sm:text-sm"
                                placeholder="Search" type="text" name="search"/>
                        </label>
                    </form>
                        <div class="relative max-w-sm mx-auto">
                            <div class="hidden absolute bg-white border border-gray-200 w-full mt-3 z-10 rounded max-h-64 overflow-y-scroll"
                                 id="search_result">

                            </div>
                        </div>
                </div>

                <div class="hidden lg:flex lg:space-x-6">
                    <button id="lg_home">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ request()->routeIs('index') ? 'stroke-blue-500' : '' }}" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </button>

                    <button id="lg_create" class="border-2 border-gray-800 rounded-lg" title="Create new post">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </button>

                    <button id="lg_github_profile">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                        </svg>
                    </button>

                    <button id="lg_login" title="Log in">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                    </button>

                    <button id="lg_logout" title="Log out">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>

<script>
    const search = $("input[name=search]")
    const searchEndpoint = `{{ route('search') }}/?q=`

    search.keyup(() => {
        $("#search_result").removeClass('hidden').html(`
                                <div class="flex justify-center items-center space-x-2 text-sm px-4 py-2.5">
                                    <div
                                        class="border-4 border-gray-100 border-t-4 border-t-gray-300 rounded-full w-6 h-6 animate-spin"></div>
                                    <span class="text-gray-500">Searching...</span>
                                </div>`)


        axios.get(searchEndpoint+search.val())
            .then(response => {
                if (response.data.result.length === 0)
                {
                    $("#search_result").html(`
                                <div class="flex justify-center text-gray-500 text-sm px-4 py-2.5">
                                    🧐 Post not found
                                </div>`)
                }

                else {
                    let html = ``
                    for (const resultElement of response.data.result) {
                        html += `
                            <div class="flex items-center space-x-4 pb-3 px-4 py-2.5 cursor-pointer hover:bg-gray-50" onclick="show('${resultElement.slug}')">
                                <div>
                                    <img src="${POST_IMAGE_URL+ '/' + JSON.parse(resultElement.filename)[0]}" alt="" class="w-10 h-10 rounded-full mx-auto" width="40" height="40">
                                </div>
                                <div class="w-56">
                                    <p class="font-semibold text-base text-gray-900">${resultElement.title}</p>
                                    <p class="block text-sm text-gray-500 truncate">${resultElement.summary}</p>
                                </div>
                            </div>`
                    }

                    $("#search_result").html(html)
                }
            })
            .catch(error => {
                $("#search_result").addClass('hidden')
            })
    })

    window.onclick = function ()
    {
        if (! $("#search_result").hasClass('hidden'))
        {
            $("#search_result").addClass('hidden')
            search.val('')
        }

    }
</script>
