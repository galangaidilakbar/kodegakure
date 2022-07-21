<x-guest-layout>
    <form>
        <input type="hidden" id="slug" value="{{ $post->slug }}">

        <x-top-navigations :header="__('Edit Post')"></x-top-navigations>

        <main class="container min-h-screen lg:my-5">
            <div class="bg-white rounded max-w-lg mx-auto lg:border">

                <div id="error_message" class="hidden px-4 py-2.5 bg-red-50 text-red-700 rounded-lg mb-3 lg:m-4"></div>
                <div id="success_message" class="hidden px-4 py-2.5 bg-green-50 text-green-700 rounded-lg mb-3 lg:m-4 capitalize flex justify-center items-center space-x-2"></div>

                <div class="mb-3">
                    <img class="object-cover rounded-t" src="{{ asset('storage/images/'.$post->filename) }}"
                         alt="{{ $post->filename }}">
                </div>

                <div class="mb-3 px-4">
                    <x-label for="title" :value="__('Title')"/>
                    <x-input id="title" class="block mt-1 w-full bg-gray-50" type="text" name="title" :value="$post->title" required />
                </div>

                <div class="mb-3 px-4">
                    <x-label for="summary" :value="__('Summary')"/>
                    <x-input id="summary" class="block mt-1 w-full bg-gray-50" type="text" name="summary" :value="$post->summary" required />
                </div>

                <div class="px-4 pb-4">
                    <x-label for="description" :value="__('Description')"/>
                    <textarea id="description" name="description" rows="4" class="resize-none mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Add description...">{{ $post->description }}</textarea>
                </div>
            </div>
        </main>
    </form>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script>
        const endpoint = `{{ route('posts.index') }}/` + $("#slug").val()

        const token = window.localStorage.getItem('tokens')
        const user = JSON.parse(window.localStorage.getItem('user'))
        if (token === null || user === null) {
            $("#store").removeClass('bg-blue-500 hover:bg-blue-600').addClass('bg-gray-500 cursor-not-allowed').prop('disabled', true)
            $("#title").addClass('cursor-not-allowed').prop('disabled', true)
            $("#summary").addClass('cursor-not-allowed').prop('disabled', true)
            $('#description').addClass('cursor-not-allowed').prop('disabled', true)
        }

        const loadingSpinner = `<div class="border-4 border-white border-t-4 border-t-green-500 rounded-full w-6 h-6 animate-spin"></div>`

        $("form").submit((event) => {
            event.preventDefault()
            $("#success_message").toggleClass('hidden').html(`${loadingSpinner}<span>uploading...</span>`)

            axios.put(endpoint, data(), {
                headers: headers()
            })
                .then((response) => {
                    $("#success_message").html(`${response.data.message} <span><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></span>`)
                    window.setTimeout(() => {
                        window.location.href = `{{ route('index') }}`
                    }, 10000)
                })
                .catch((error) => {
                    $("#success_message").toggleClass('hidden')
                    $("#error_message").toggleClass('hidden').text(`${error.response.statusText}`)
                })
        })

        function data()
        {
            return {
                'title' : $('#title').val(),
                'summary' : $('#summary').val(),
                'description' : $('#description').val()
            }
        }

        function headers()
        {
            return {
                'Accept' : 'application/json',
                'Authorization': `Bearer ${token}`
            }
        }
    </script>
</x-guest-layout>
