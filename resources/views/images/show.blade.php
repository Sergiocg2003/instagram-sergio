<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Detalles de la imagen') }}
    </h2>
  </x-slot>

  <div class="py-8 flex flex-wrap md:flex-nowrap">
        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
            <img src="{{ asset($image->user->image) }}" alt="" class="w-8 h-8 rounded-full object-cover mr-2">
            <span class="font-semibold title-font text-white">{{$image->user->name}}</span>
            <span class="font-semibold title-font text-white">{{'@'}}{{$image->user->nick}}</span>
            
        </div>
        <div class="md:flex-grow">
            <img class="leading-relaxed" src="{{ asset($image->image_path) }}">
            <p class="font-semibold title-font text-white">{{'@'}}{{$image->user->nick}}|{{$image->updated_at}}</p>
            <p class="font-semibold title-font text-white">{{$image->description}}</p>
        </div>
        <div class="md:w-64 md:mb-0 mb-6 flex-shrink-0 flex flex-col">
            <span class="font-semibold title-font text-white">{{$image->comment_count}} Comentarios</span>
            <span class="font-semibold title-font text-white">{{$image->like_count}} Likes</span>
            @if(Auth::user()->id == $image->user_id)
            <a href="{{ route("images.edit", ["image" => $image]) }}"
            class="text-indigo-500 inline-flex items-center mt-4">
            {{ __("Editar") }}
                <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2"
                fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
            </a>
            <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-image-deletion')">
            {{ __("Eliminar") }}
            <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2"
                fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="M12 5l7 7-7 7"></path>
                </svg>
            </x-danger-button>
            <x-modal name="confirm-image-deletion" :show="$errors->imageDeletion->isNotEmpty()" focusable>
                <form method="post" action="{{ route('images.destroy', $image->id) }}" class="p-6">
                    @csrf
                    @method('delete')

                    <h2 class="text-lg font-medium text-gray-900">¿Estas seguro de que quieres borrar esta imagen?</h2>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancelar') }}
                        </x-secondary-button>
                        <x-danger-button class="ml-3">
                            {{ __('Borrar imagen') }}
                        </x-danger-button>
                    </div>
                </form>
            </x-modal>
            @endif
        </div>
    </div>
</x-app-layout>