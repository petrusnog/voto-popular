<form wire:submit.prevent="createIdea" method="POST" class="space-y-4 py-6">
    <div>
        <input required wire:model="title" type="text" name="idea_title" class="w-full h-10 border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 placeholder:text-xs" placeholder="Título da votação">
        @error('title') <span class="text-red text-xs ml-1">{{ $message }}</span> @enderror
    </div>
    <div>
        @if(!$categories->isEmpty())
            <select wire:model="category" name="idea_category_id" class="w-full h-10 border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 text-xs">
                @foreach ($categories as $category)
                    {{ $category }}
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        @endif
        @error('category_id') <span class="text-red text-xs ml-1">{{ $message }}</span> @enderror
    </div>
    <div>
        <textarea required wire:model="description" type="text" name="idea_description" class="w-full h-40 resize-none border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 placeholder:text-xs" placeholder="Descreva a sua votação"></textarea>
        @error('description') <span class="text-red text-xs ml-1">{{ $message }}</span> @enderror
    </div>
    <button type="submit" class="bg-blue text-white font-semibold w-full h-10 rounded-xl border-2 border-blue hover:bg-white hover:text-blue transition duration-150 ease-in flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <span class="ml-2">Publicar</span>
    </button>

    <div>
        @if(session('success_message'))
            <div
                x-data="{ isVisible: true }"
                x-init="
                    setTimeout(() => {
                        isVisible = false
                    }, 5000)"
                "
                x-show="isVisible"
                x-transition.duration.500ms
                class="bg-emerald-400 text-white text-center border-green-500 text-green-700 py-2 px-4 w-full rounded" role="alert"
            >
                {{ session('success_message') }}
            </div>
        @endif
    </div>
</form>
