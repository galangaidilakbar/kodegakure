<x-guest-layout>
    <x-top-navigations :header="__('Kodegakure')"></x-top-navigations>

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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        $("#store").text('Share')
        let desc = `{!! $post->description !!}`
        $('#content').html(marked.parse(desc))
    </script>
</x-guest-layout>
