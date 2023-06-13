<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Subir una imagen') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="bg-red-500 text-white p-4">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ $action }}" enctype="multipart/form-data">
                @csrf
                @if($image->id)
                    @method("PUT")
                @endif
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="relative mb-4">
                        <label for="image_path" class="leading-7 text-sm text-gray-600">{{ __("Imagen") }} </label>
                        <input id="image_path" class="block mt-1 w-full" type="file" name="image_path" :value="old('image_path')" required autofocus autocomplete="image_path" />
                    </div>
                    <div class="relative mb-4">
                        <label for="description" class="leading-7 text-sm text-gray-600">{{ __("Descripcion") }}</label>
                        <input type="text" id="description" name="description" value="{{ old("description", $image->description) }}" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">{{__("Subir Imagen")}}</button>
                </div>
            </form>
        </div>
    </div>


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
