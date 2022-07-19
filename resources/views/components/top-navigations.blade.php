@props(['header'])

<div class="bg-white lg:border-b lg:border-gray-200">
    <div class="container">
        <div class="flex justify-between items-center max-w-lg mx-auto py-4 px-4 lg:px-0">
            <a class="flex-none p-1.5 rounded-full hover:bg-gray-100" href="{{ route('index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>

            <div class="shrink">
                <span class="font-semibold text-xl">{{ $header }}</span>
            </div>

            <button class="flex-none px-2.5 py-1.5 rounded-lg bg-blue-500 hover:bg-blue-600 text-white" id="store">
                Save
            </button>
        </div>
    </div>
</div>
