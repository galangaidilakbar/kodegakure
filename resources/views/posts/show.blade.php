<x-guest-layout>
    <div class="container max-w-lg">
        <div class="my-3">
            <img class="object-cover" src="{{ asset('storage/images/'.$post->filename) }}"
                 alt="{{ $post->filename }}">
        </div>

        <div class="px-4 lg:px-0 my-3 selection:bg-fuchsia-300 selection:text-fuchsia-900">
            <p>{{ $post->description }}</p>
        </div>
    </div>
</x-guest-layout>
