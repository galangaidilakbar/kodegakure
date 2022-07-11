<x-guest-layout>
    <div class="container max-w-lg">
        <div class="flex justify-between items-center mb-3 px-4 lg:px-0 py-2.5">
            <a href="/">
                <i class="bi bi-arrow-left"></i>
            </a>
            <a href="/" class="font-semibold text-2xl">{{ config('app.name') }}</a>
            <button>
                <i class="bi bi-upload"></i>
            </button>
        </div>

        <div class="my-3">
            <img class="object-cover" src="{{ asset('storage/images/'.$post->filename) }}"
                 alt="{{ $post->filename }}">
        </div>

        <div class="px-4 lg:px-0 my-3 selection:bg-fuchsia-300 selection:text-fuchsia-900">
            <p>{{ $post->description }}</p>
        </div>
    </div>
</x-guest-layout>
