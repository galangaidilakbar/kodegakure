<x-guest-layout>
    <form>
        @csrf
        <input type="hidden" id="slug" value="{{ $post->slug }}">

        <x-top-navigations :header="__('Edit Post')"></x-top-navigations>

        <main class="container min-h-screen lg:my-5">
            <div class="bg-white rounded max-w-lg mx-auto lg:border">

                <div id="error_message" class="hidden px-4 py-2.5 bg-red-50 text-red-700 rounded-lg mb-3 lg:m-4"></div>
                <div id="success_message" class="hidden px-4 py-2.5 bg-green-50 text-green-700 rounded-lg mb-3 lg:m-4 capitalize"></div>

                <div class="mb-3">
                    <img class="object-cover" src="{{ asset('storage/images/'.$post->filename) }}"
                         alt="{{ $post->filename }}">
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

        if (token === null) {
            $("#store").removeClass('bg-blue-500 hover:bg-blue-600').addClass('bg-gray-500 cursor-not-allowed')
        }

        $("#description").focus()

        $("form").submit((event) => {
            event.preventDefault()

            const headers = {
                'Accept' : 'application/json',
                'Authorization': `Bearer ${window.localStorage.getItem('tokens')}`
            };

            axios.put(endpoint, {
                description: $("#description").val()
            }, {
                headers
            })
                .then((response) => {
                    $("#success_message").toggleClass('hidden').text(`${response.data.message}`)
                    window.setTimeout(() => {
                        window.location.href = `{{ route('index') }}`
                    }, 1000)
                })
                .catch((error) => {
                    $("#error_message").toggleClass('hidden').text(`${error.response.statusText}`)
                })
        })
    </script>
</x-guest-layout>
