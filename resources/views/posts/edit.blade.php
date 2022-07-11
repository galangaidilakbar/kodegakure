<x-guest-layout>
    <form action="{{ route('posts.update', $post->slug) }}" method="post">
        @csrf
        @method('put')

        <div class="container">
            <div class="flex justify-between items-center py-2.5 px-4 lg:px-0">
                <a class="flex-none p-1.5 rounded-full hover:bg-gray-100" href="{{ url()->previous() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>

                <div class="flex-1 text-center">
                    <a href="/" class="font-semibold text-2xl">{{config('app.name')}}</a>
                </div>

                <button class="flex-none px-2.5 py-1.5 rounded-lg bg-blue-500 hover:bg-blue-600 text-white" id="store">
                    Save
                </button>
            </div>
        </div>

        <main class="container mt-3">
            <div class="px-4 container max-w-lg lg:px-0">
                @if($errors->any())
                    <div class="bg-red-100 text-red-700 py-2 px-4 rounded-lg">
                        <span class="font-semibold">
                            Oupss! We can process ur request because:
                        </span>
                        <ul class="list-disc px-6">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="my-3">
                    <img class="object-cover" src="{{ asset('storage/images/'.$post->filename) }}"
                         alt="{{ $post->filename }}">
                </div>

                <div>
                    <x-label for="description" :value="__('Deskripsi')"/>

                    <textarea id="description" name="description" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Leave a comment...">{{ $post->description }}</textarea>
                </div>
            </div>
        </main>
    </form>

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $(document).ready(() => {
            $("#store").click(() => {
                $("#store").text('process')
            })

            $("#description").focus()
        })
    </script>
</x-guest-layout>
