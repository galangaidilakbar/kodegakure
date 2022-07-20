<x-guest-layout>
    <div class="container max-w-lg">
        <div class="flex justify-between items-center space-x-4 mb-3 px-4 lg:px-0 py-2.5">
            <a href="{{ route('index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <span class="font-semibold text-xl">{{ config('app.name') }}</span>

            <div></div>
        </div>

        <div class="my-3">
            <img class="object-cover" src="{{ asset('storage/images/' . $post->filename) }}"
                alt="{{ $post->filename }}">
        </div>

        <div class="px-4 py-2.5 my-3 selection:bg-fuchsia-300 selection:text-fuchsia-900" id="content">

        </div>

        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script>
            let desc = `{!! $post->description !!}`
            document.getElementById('content').innerHTML =
                marked.parse(desc);
        </script>

    </div>
</x-guest-layout>
