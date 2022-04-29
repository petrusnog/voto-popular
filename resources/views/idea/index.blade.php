<x-app-layout>
    <div class="filters flex flex-col space-y-3 md:flex-row md:space-x-6 md:space-y-0">
        <div class="w-full md:w-1/3">
            <select name="category" id="category" class="w-full rounded-xl pl-4 pr-10 py-2 border-none">
                <option class="pr-4" value="">Todas as categorias</option>
                @foreach ($categories as $category)
                    <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-2/3 relative">
            <input type="search" placeholder="Encontre uma ideia" class="rounded-xl w-full bg-white pl-8 border-none placeholder:text-gray-400">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div> <!-- END filters -->

    <div 
        class="ideas-container space-y-6 my-6"
    >
    @foreach ($ideas as $idea)
        <div
            x-data="{ isOpen: false }" 
            x-on:click="const target = $event.target.tagName.toLowerCase()
                const ideaLink = $event.target.closest('.idea-container').querySelector('.idea-link')
                const ignores = ['button', 'a', 'input', 'select', 'textarea', 'svg', 'path']
                if (ignores.includes(target)) return
                ideaLink.click()
            "
            class="idea-container bg-white rounded-xl flex flex-col md:flex-row justify-between px-4 py-4 md:py-6 hover:shadow-md duration-150 ease-in md:cursor-pointer mb-5"
        >
            <div class="about-component flex mb-4 md:mb-0">
                <div class="flex-none">
                    <a href="#">
                        <img src="{{$idea->user->getAvatar()}}" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="mx-4">
                    <h4 class="text-xl font-semibold mb-2">
                        <a href="{{route('idea.show', $idea)}}" class="idea-link hover:underline">{{ $idea->title }}</a>
                    </h4>
                    <p class="line-clamp-3">{{ $idea->description }}</p>
                    <div class="flex">
                        <a href="{{route('idea.show', $idea)}}" class="w-28 h-10 md:h-auto md:w-20 items-center font-bold text-xs rounded-xl px-2 transition duration-150 ease-in bg-gray-300 hover:bg-gray-400 mt-4 mr-2 flex items-center justify-center">Ver mais</a>
                        <button
                            x-on:click="isOpen = !isOpen"
                            class="relative items-center font-bold text-xs text-gray-400 rounded-xl px-2 transition duration-150 ease-in bg-gray-200 hover:bg-gray-300 mt-4"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                            <ul
                                x-show="isOpen"
                                class="absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3 text-black text-left"
                            >
                                <li><a href="#" class="hover:bg-gray-100 block px-5 py-3 transition duration-150 ease-in">Marcar como spam</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block px-5 py-3 transition duration-150 ease-in text-red">Deletar ideia</a></li>
                            </ul>
                        </button>
                    </div>
                    <div class="flex justify-between mt-6">
                        <div class="flex items-center text-gray-400 text-xs font-semibold space-x-2">
                            <div>{{$idea->created_at->diffForHumans()}}</div>
                            <div>&bull;</div>
                            <div>Geral</div>
                            <div>&bull;</div>
                            <div>3 comentários</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="voting-component-desktop hidden md:flex">
                <div class="border-l border-gray-100 px-4 py-8 text-center flex flex-col justify-center items-center">
                    <div class="font-semibold text-2xl text-green">322</div>
                    <div class="mt-4">
                        <button class="w-20 font-bold text-xs uppercase rounded-xl py-2 px-2 transition duration-150 ease-in border-2 border-green bg-white text-green hover:bg-green hover:text-white">Sim</button>
                    </div>
                </div>
                <div class="border-l border-gray-100 px-4 py-8 text-center flex flex-col justify-center items-center">
                    <div class="font-semibold text-2xl text-red">322</div>
                    <div class="mt-4">
                        <button class="w-20 font-bold text-xs uppercase rounded-xl py-2 px-2 transition duration-150 ease-in border-2 border-red bg-white text-red hover:text-white hover:bg-red">Não</button>
                    </div>
                </div>
            </div>
            <div class="voting-component-mobile flex justify-around md:hidden">
                <div class="voting-option flex items-center justify-center bg-green rounded-full">
                    <div class="font-semibold text-xl text-white px-4 flex items-center">322</div>
                    <button class="w-20 font-bold text-xs uppercase rounded-full py-3 px-3 transition duration-150 ease-in border-2 border-green bg-white text-green hover:bg-green hover:text-white">Sim</button>
                </div>
                <div class="voting-option flex items-center justify-center bg-red rounded-full">
                    <div class="font-semibold text-xl text-white px-4 flex items-center">322</div>
                    <button class="w-20 font-bold text-xs uppercase rounded-full py-3 px-3 transition duration-150 ease-in border-2 border-red bg-white text-red hover:text-white hover:bg-red">Não</button>
                </div>
            </div>
        </div> <!-- END idea-container -->
    @endforeach
    </div><!-- END ideas-container -->

    <div class="my-8">
            {{ $ideas->links() }}
    </div>
</x-app-layout>
