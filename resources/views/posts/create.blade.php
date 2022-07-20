<x-guest-layout>
    <form>
        @csrf

        <x-top-navigations :header="__('Create Post')"></x-top-navigations>

        <main class="container min-h-screen lg:my-5">
            <div class="bg-white rounded px-4 py-2.5 max-w-lg mx-auto lg:border">

                <div id="error_message" class="hidden mb-3 bg-red-100 text-red-700 py-2 px-4 rounded-lg">
                    <span class="font-semibold">
                        Ouups! something when wrong,
                    </span>
                    <ul class="list-disc px-6">

                    </ul>
                </div>

                <div id="success_message" class="hidden bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-3">
                    <span class="capitalize"></span>
                </div>

                <div class="mb-3">
                    <x-label for="filename" :value="__('Image')"/>
                    <input type="file" name="filename" id="filename" class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 text-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="pb-3">
                    <x-label for="description" :value="__('Description')"/>
                    <textarea id="description" name="description" rows="4" class="resize-none mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Add description..." required></textarea>
                </div>
            </div>
        </main>
    </form>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script>
        const endpoint = `{{ route('posts.index') }}`;

        const token = window.localStorage.getItem('tokens')

        if (token === null) {
            $("#store").removeClass('bg-blue-500 hover:bg-blue-600').addClass('bg-gray-500 cursor-not-allowed').prop('disabled', true)
            $('#filename').addClass('cursor-not-allowed').prop('disabled', true)
            $('#description').addClass('cursor-not-allowed').prop('disabled', true)
        }

        $('form').submit(event => {
            event.preventDefault();

            $("#store").addClass('cursor-not-allowed').prop('disabled', true)

            $("#success_message").toggleClass('hidden')
            $("#success_message span").text('Uploading...')

            const formData = new FormData;
            formData.append('filename', $('#filename')[0].files[0]);
            formData.append('description', $('#description').val());

            const headers = {
                'Content-Type': 'multipart/form-data',
                'Accept' : 'application/json',
                'Authorization': `Bearer ${window.localStorage.getItem('tokens')}`
            };

            axios.post(endpoint, formData, {
                headers
            })
                .then(response => {
                    console.log(response)
                    if (response.status === 201){
                        $("#error_message").toggleClass('hidden')
                        $("#success_message span").text(response.data.message)
                        $('#filename').val('')
                        $('#description').val('')

                        window.setTimeout(() => {
                            window.location.href = `{{ route('index') }}`
                        }, 1000);
                    }
                })
                .catch(error => {
                    $("#success_message").toggleClass('hidden')
                    $("#error_message").toggleClass('hidden')

                    if (error.response.status === 401){
                        $("#error_message").html(`Unauthorized`)
                    }

                    if ( error.response.status === 422) {
                        $("#error_message ul").html(``)
                        const errorMessage = error.response.data.errors
                        Object.keys(errorMessage).forEach((key) => {
                            const errors = errorMessage[key]
                            $("#error_message ul").append(`<li>${errors}</li>`)
                        })
                    }
                })
                .finally(() => {
                    $("#store").removeClass('cursor-not-allowed').prop('disabled', false)
                })
        })
    </script>
</x-guest-layout>
