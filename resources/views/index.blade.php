<x-main-layout>
    <div id="app" class="container lg:my-1">
        <div class="min-h-screen flex items-center justify-center">
            <div class="border-8 border-gray-200 border-t-8 border-t-blue-500 rounded-full w-24 h-24 animate-spin"></div>
        </div>
    </div>

    @section('script')
        <script>
            const PROFILE_PICTURE_URL = '{{ asset('MgLSVWnD_400x400.jpeg') }}'
            const POST_IMAGE_URL = '{{ asset('/storage/images/') }}'
            const POSTS_URL = `{{ route('posts.index') }}`
            const CSRF_TOKEN = `{{ @csrf_token() }}`

            $(document).ready(() => {
                $("#create").click(() => {
                    window.location.href = `{{ route('posts.create') }}`
                })

                renderPosts()

                async function index() {
                    try {
                        let response = fetch(POSTS_URL)
                        return (await response).json()
                    } catch (error) {
                        console.log(error)
                    }
                }

                async function renderPosts() {
                    let posts = await index()
                    let html = ``

                    posts.posts.forEach(post => {
                        html += `<div id="post_number_${post.slug}" class="max-w-lg mx-auto bg-white lg:border lg:rounded lg:mb-3">`+postHeader(post.slug)+postImage(post.filename)+postUtilities(post.slug)+postText(post.description, post.slug)+`</div>`
                    })

                    $("#app").html(html)
                }

                function postHeader(slug) {
                    return `
                            <div class="relative">
                                <div class="flex justify-between items-center px-4 py-3">
                                    <div class="flex space-x-1 items-center">
                                        <img src="${PROFILE_PICTURE_URL}" alt="Hokage" class="w-14 h-14 rounded-full">
                                        <p class="text-sm font-semibold">Galang Aidil Akbar</p>
                                    </div>

                                    <button onclick="postHeaderOptions('${slug}')">
                                        ${heroIcons.outline.dotsVertical}
                                    </button>
                                </div>

                                <div id="kg_options_${slug}" class="hidden absolute z-10 top-14 right-4 bg-white divide-y divide-gray-100 rounded shadow-md w-44">
                                    <ul class="py-1 text-sm text-gray-700" aria-labelledby="dropdownInformationButton">
                                        <li>
                                            <a href="${POSTS_URL+'/'+slug+'/edit'}"
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
                                        <button class="w-full text-left px-4 py-2 bg-red-50 text-red-700 text-sm" onclick="destroy('${slug}')">Delete</button>
                                    </div>
                                </div>
                            </div>
                            `
                }

                function postImage(filename) {
                    return `
                        <div class="my-3">
                            <img class="object-cover max-w-full mx-auto" src="${POST_IMAGE_URL + '/' + filename}" alt="${filename}" >
                        </div>
                    `
                }

                function postUtilities(slug) {
                    return `
                            <div class="px-4 flex justify-between items-center">
                                <div class="flex space-x-3 items-center">
                                    <button id="post_utilities_love_${slug}" onclick="postUtilitiesLove(this.id)">${heroIcons.outline.love}</button>
                                    <button onclick="console.log('chat clicked')">${heroIcons.outline.chat}</button>
                                    <button onclick="console.log('paper clicked')">${heroIcons.outline.paper}</button>
                                </div>
                                <button id="post_utilities_bookmark_${slug}" onclick="postUtilitiesBookmark(this.id)">${heroIcons.outline.bookmark}</button>
                            </div>
                            `
                }

                function postText(text, slug) {
                    return `<div class="px-4 py-2 w-56 flex space-x-2">
                                <p class="truncate">${text}</p>
                                <button class="text-gray-500" onclick="show('${slug}')">more</button>
                            </div>`
                }

                const heroIcons = {
                    outline: {
                        dotsVertical: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" /></svg>`,
                        love: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>`,
                        chat: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" /></svg>`,
                        paper: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>`,
                        bookmark: `<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" /></svg>`
                    },
                    solid: {

                    }
                }
            })

            function show(slug) {
                window.location.href = POSTS_URL+'/'+slug
            }

            function destroy(slug){
                fetch(POSTS_URL+'/'+slug, {
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-Requested-With": "XMLHttpRequest",
                        "X-CSRF-Token": CSRF_TOKEN
                    },
                    method: 'DELETE'
                })
                    .then(() => {
                        $(`#post_number_${slug}`).remove()
                    })
                    .catch(error => {
                        console.log(error)
                    })
            }

            function postHeaderOptions(slug) {
                $(`#kg_options_${slug}`).toggleClass('hidden')
            }

            function postUtilitiesLove(slug) {
                $(`#${slug} svg`).toggleClass('fill-red-500 stroke-inherit')
            }

            function postUtilitiesBookmark(slug){
                $(`#${slug} svg`).toggleClass('fill-yellow-400 stroke-inherit')
            }
        </script>
    @endsection
</x-main-layout>

