<x-guest-layout>
    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <x-top-navigations :header="__('Create Post')"></x-top-navigations>

        <main class="container mt-3">
            <div class="px-4 max-w-lg mx-auto lg:px-0">

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
                    <x-label for="filename" :value="__('Image')"/>
                    <input type="file" name="filename" id="filename" class="mt-1 block w-full border border-gray-300 rounded-lg p-2.5 text-sm bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <x-label for="description" :value="__('Description')"/>
                    <textarea id="description" name="description" rows="4" class="mt-1 block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Add description..."></textarea>
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
        })
    </script>
</x-guest-layout>
