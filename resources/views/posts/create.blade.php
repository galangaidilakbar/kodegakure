<x-guest-layout>
    <form>
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

                <div id="success_message" class="hidden bg-green-100 text-green-700 px-4 py-2 rounded-lg mb-3 capitalize flex justify-center items-center space-x-2">

                </div>

                <div class="mb-3">
                    <x-label for="filename" :value="__('Image')"/>
                    <input type="file" name="filename" id="filename" class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 text-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500" required>
                </div>

                <div class="mb-3">
                    <x-label for="title" :value="__('Title')"/>
                    <x-input id="title" class="block mt-1 w-full bg-gray-50" type="text" name="title" :value="old('title')" required />
                </div>

                <div class="mb-3">
                    <x-label for="summary" :value="__('Summary')"/>
                    <x-input id="summary" class="block mt-1 w-full bg-gray-50" type="text" name="summary" :value="old('summary')" required />
                </div>

                <div class="pb-3">
                    <x-label for="description" :value="__('Description')"/>
                    <textarea id="description" name="description" rows="6" class="resize-none mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Add description..." required></textarea>
                </div>
            </div>
        </main>
    </form>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script>
        const endpoint = `{{ route('posts.index') }}`;

        const token = window.localStorage.getItem('tokens')
        const user = JSON.parse(window.localStorage.getItem('user'))

        if (token === null) {
            $("#store").removeClass('bg-blue-500 hover:bg-blue-600').addClass('bg-gray-500 cursor-not-allowed').prop('disabled', true)
            $("#title").addClass('cursor-not-allowed').prop('disabled', true)
            $("#summary").addClass('cursor-not-allowed').prop('disabled', true)
            $('#filename').addClass('cursor-not-allowed').prop('disabled', true)
            $('#description').addClass('cursor-not-allowed').prop('disabled', true)
        }

        const loadingSpinner = `<div class="border-4 border-white border-t-4 border-t-green-500 rounded-full w-6 h-6 animate-spin"></div>`

        $('form').submit(event => {
            event.preventDefault();
            $("#store").addClass('cursor-not-allowed').prop('disabled', true)
            $("#success_message").toggleClass('hidden').html(`${loadingSpinner}<span>uploading...</span>`)

            axios.post(endpoint, data(), {
                headers: headers()
            })
                .then(response => {
                    if (response.status === 201){
                        $("#success_message").html(`<span><svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-700" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg></span> <div>${response.data.message}</div>`);
                        $("#title").val('');
                        $("#summary").val('');
                        $('#filename').val('');
                        $('#description').val('');

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

        function data()
        {
            const data = new FormData;
            data.append('user_id', user.id);
            data.append('title', $("#title").val());
            data.append('summary', $("#summary").val());
            data.append('filename', $('#filename')[0].files[0]);
            data.append('description', $('#description').val());
            return data;
        }

        function headers()
        {
            return {
                'Content-Type': 'multipart/form-data',
                'Accept' : 'application/json',
                'Authorization': `Bearer ${token}`
            }
        }
    </script>
</x-guest-layout>
