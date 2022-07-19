<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div id="error_message" class="hidden mb-3 bg-red-100 text-red-700 py-2 px-4 rounded-lg">
            <span class="font-semibold">
                Ouups! something when wrong,
            </span>
            <ul class="list-disc px-6">

            </ul>
        </div>

        <form>
            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>

    <script>
        const endpoint = `{{ route('authentication') }}`
        let sanctumToken = ``

        $('form').submit((event) => {
            event.preventDefault();

            const formData = new FormData;

            formData.append('email', $("#email").val())
            formData.append('password', $("#password").val())

            const options = {
                headers: {
                    Accept: "application/json"
                }
            }

            axios.post(endpoint, formData, options)
                .then((response) => {
                    sanctumToken = response.data
                    window.localStorage.setItem('tokens', sanctumToken)

                    window.setTimeout(() => {
                        window.location.href = `{{ route('index') }}`
                    }, 1000);
                })
                .catch((error) => {
                    $("#error_message").toggleClass('hidden')
                    const errorMessageElement = $("#error_message ul")
                    errorMessageElement.html('')
                    errorMessageElement.append(`<li>${error.response.data.message}</li>`)
                })
        })
    </script>

</x-guest-layout>
