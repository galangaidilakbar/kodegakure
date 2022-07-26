<x-guest-layout>
    <x-top-navigations :header="__('Kodegakure')"></x-top-navigations>

    <div class="container max-w-lg min-h-screen">
        <div class="bg-white rounded lg:border lg:my-5">

            <div class="mb-3 px-4 py-2.5">
                <h1 id="title" class="prose mb-3"></h1>
                <span class="text-sm text-gray-500" id="post_author_and_time_published"></span>
            </div>

            <div class="splide mb-3" role="group" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($post->filename as $file)
                            <li class="splide__slide">
                                <img class="object-cover lg:rounded" src="{{ asset('storage/images/' . $file) }}" alt="{{ $file }}">
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="px-4 py-2.5 mb-3 selection:bg-fuchsia-300 selection:text-fuchsia-900">
                <article class="prose" id="content">
                </article>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/marked.min.js') }}"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script>
        new Splide( '.splide' ).mount();
        // dynamically page title
        document.title = `{{ $post->title }} - {{ config('app.name') }}`
        $("head").append(`<meta name="description" content="{{ $post->summary }}">`)

        // change text button store to share
        $("#store").text('Share')

        // render post title
        let title = `# {!! $post->title !!}`
        $("#title").html(marked.parse(title))

        // render author and time
        let author = `{{ $post->user->name }}`
        let created_at = `{{ $post->created_at->diffForHumans() }}`
        $("#post_author_and_time_published").text(`By ${author}, published ${created_at}`)

        // render description
        let desc = `{!! $post->description !!}`
        $('#content').html(marked.parse(desc))
    </script>
</x-guest-layout>
