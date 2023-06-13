<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Imagenes') }}
        </h2>
    </x-slot>

    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-24 mx-auto">
            <div class="-my-8 divide-y-2 divide-gray-100">
                @foreach($images as $image)
                <div class="py-8 flex flex-wrap md:flex-nowrap">
                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                        <img src="{{ $image->user->image }}" alt="" class="w-8 h-8 rounded-full object-cover mr-2">
                        <span class="font-semibold title-font text-white">{{$image->user->name}}</span>
                        <span class="font-semibold title-font text-white-900">{{'@'}}{{$image->user->nick}}</span>
                    </div>
                    <div class="md:flex-grow">
                        <img class="leading-relaxed" src="{{ $image->image_path }}">
                        <p class="font-semibold title-font text-white-900">{{'@'}}{{$image->user->nick}}|{{$image->updated_at}}</p>
                        <p class="font-semibold title-font text-white">{{$image->description}}</p>
                    </div>
                    <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
                        <div class="flex gap-5">
                            <a href="{{ route("images.show", $image) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </a>

                        </div>
                        <span class="font-semibold title-font text-white">{{$image->comment_count}} Comentarios</span>
                        <span class="font-semibold title-font text-white">{{$image->like_count}} Likes</span>
                    </div>
                </div>
                @endforeach
                {{ $images->links() }}
            </div>
        </div>
    </section>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
