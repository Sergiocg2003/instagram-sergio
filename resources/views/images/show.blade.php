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
            <form method="POST" action="{{ route('comments.store') }}" style="display:flex; flex-direction:column;  align-items:center;" class="mt-4">
                @csrf
                <label for="description" style="width:100%; text-align:center; color:white;">NUEVO COMENTARIO:</label>
                <input type="hidden" name="user_id" value="{{ $image->user->id }}">
                <input type="hidden" name="image_id" value="{{ $image->id }}">
                <textarea style="color:black; width: 100%" id="story" name="content" rows="5" placeholder="Escribe aqui tu comentario" class="bg-white border rounded-sm max-w-md" required></textarea>
                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                <x-primary-button>Publicar comentario</x-primary-button>
            </form>
            @foreach($image->comment as $comment)
                <div class="font-semibold p-2.5">
                    <div class="flex flex-row flex-wrap ">
                        <img src="{{ asset($comment->user->image)}}" alt="" class="object-cover w-8 h-8 border-2 border-gray-300 rounded-full">
                        <div class="flex-col mt-1">
                            <div class="flex items-center flex-1 px-4 font-bold leading-tight text-white">{{'@'}}{{ $comment->user->nick}}
                                <span class="ml-2 text-xs font-normal text-gray-500"></span>
                            </div>
                            <div class="flex flex-wrap">
                                <p class="w-[640px] mt-3 ml-3 mr-3 text-white" >{{ $comment->content}}</p>
                            </div>
                        </div>
                    </div>
                    @if(Auth::user()->id == $image->user_id || Auth::user()->id == $comment->user_id)
                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-comment-deletion-{{$comment->id}}')">
                        {{ __("Eliminar") }}
                        <svg class="w-4 h-4 ml-2" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2"
                            fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5l7 7-7 7"></path>
                            </svg>
                        </x-danger-button>
                        <x-modal name="confirm-comment-deletion-{{$comment->id}}" :show="$errors->commentDeletion->isNotEmpty()" focusable>
                            <form method="post" action="{{ route('comments.destroy', $comment->id) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-white">¿Estas seguro de que quieres borrar este comentario?</h2>

                                <div class="mt-6 flex justify-end">
                                    <x-secondary-button x-on:click="$dispatch('close')">
                                        {{ __('Cancelar') }}
                                    </x-secondary-button>
                                    <x-danger-button class="ml-3">
                                        {{ __('Borrar comentario') }}
                                    </x-danger-button>
                                </div>
                            </form>
                        </x-modal>
                    @endif
                </div>
            @endforeach
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

                        <h2 class="text-lg font-medium text-white">¿Estas seguro de que quieres borrar esta imagen?</h2>

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