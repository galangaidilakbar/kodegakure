<x-guest-layout>
    @include('layouts.top-header')
    <div class="container max-w-lg min-h-screen">
        <div class="bg-white rounded lg:border lg:my-5">
            <div>
                <img class="object-cover lg:rounded" src="{{ asset('storage/images/' . $post->filename) }}"
                    alt="{{ $post->filename }}">
            </div>
            <div class="px-4 py-2.5 my-3 selection:bg-fuchsia-300 selection:text-fuchsia-900">
                <article class="prose lg:prose-xl" id="content">
                </article>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
        <script>
            let desc = `{!! $post->description !!}`
            document.getElementById('content').innerHTML =
                marked.parse(desc);
        </script>

    </div>
</x-guest-layout>
