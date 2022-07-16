<x-guest-layout>
    <form action="{{ route('posts.update', $post->slug) }}" method="post">
        @csrf
        @method('put')

        <x-top-navigations :header="__('Edit Post')"></x-top-navigations>

        <main class="container mt-3">
            <div class="max-w-lg mx-auto">

                @if($errors->any())
                    <div class="mx-4 bg-red-100 text-red-700 py-2 px-4 rounded-lg">
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

                <div class="px-4 lg:px-0">
                    <x-label for="description" :value="__('Description')"/>

                    <textarea id="description" name="description" rows="4" class="resize-none mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Add description...">{{ $post->description }}</textarea>
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
