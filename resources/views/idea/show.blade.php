<x-app-layout>
    <div>
        <div class="flex items-center font-semibold mb-5">
            <a href="{{route('idea.index')}}" class="flex items-center hover:underline">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="ml-2">Todas as votações</span>
            </a>
        </div>

        <div
            x-data="{isOpen: false}" 
            class="idea-container bg-white rounded-xl flex flex-col md:flex-row justify-between px-4 py-4 md:py-6 hover:shadow-md duration-150 ease-in md:cursor-pointer mb-5"
        >
            <div class="flex">
                <div class="flex-none">
                    <a href="#">
                        <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                    </a>
                </div>
                <div class="mx-4 flex flex-1 flex-col justify-between">
                    <h4 class="text-xl font-semibold mb-2">
                        <a href="{{route('idea.show', $idea)}}" class="hover:underline">{{$idea->title}}</a>
                    </h4>
                    <p class="block md:hidden text-blue font-bold uppercase text-xs w-full my-2">{{$user->name}}</p>
                    <p>{{$idea->description}}</p>
                    <div class="flex">
                        <button
                            @click="isOpen = !isOpen"
                            class="relative items-center font-bold text-xs text-gray-400 rounded-xl px-2 transition duration-150 ease-in bg-gray-200 hover:bg-gray-300 mt-4"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                            </svg>
                            <ul
                                x-show="isOpen"
                                class="absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3 text-black text-left z-10"
                            >
                                <li><a href="#" class="hover:bg-gray-100 block px-5 py-3 transition duration-150 ease-in">Marcar como spam</a></li>
                                <li><a href="#" class="hover:bg-gray-100 block px-5 py-3 transition duration-150 ease-in text-red">Deletar ideia</a></li>
                            </ul>
                        </button>
                    </div>
                    <div class="text-2xl text-yellow flex font-bold items-center mt-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="ml-2">Termina em 3 dias</span>
                    </div>
                    <div class="flex justify-between mt-6">
                        <div class="flex items-center text-gray-400 text-xs font-semibold space-x-2">
                            <div class="hidden md:block font-bold text-gray-900">{{$user->name}}</div>
                            <div>&bull;</div>
                            <div>10 horas atrás</div>
                            <div>&bull;</div>
                            <div>Geral</div>
                            <div>&bull;</div>
                            <div class="text-gray-900">3 comentários</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="voting-component-mobile flex justify-around md:hidden mt-4">
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

        <div 
            x-data="{isOpen:false}" 
            class="buttons-container flex justify-between items-center"
        >
            <div class="relative">
                <button
                    x-on:click="isOpen = !isOpen"
                    class="w-50 py-2 px-8 bg-blue rounded-xl font-semibold text-white border-2 border-blue transition duration-150 ease-in hover:text-blue hover:bg-white"
                >
                    Responder
                </button>
                <div 
                    x-show="isOpen" 
                    class="absolute z-20 w-80 md:w-96 bg-white rounded-xl shadow-md cursor-pointer mt-4"
                >
                    <form action="#" class="px-4 py-4">
                        <textarea name="reply_add" placeholder="Escreva sua resposta aqui..." class="w-full h-40 resize-none border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 placeholder:text-xs" cols="30" rows="10"></textarea>
                        <div class="text-xs text-gray-400">Lembre-se de ser tolerante e respeitoso, afinal todos tem direito a ter uma opinião :)</div>
                        <div class="flex pt-4 justify-end">
                            <button class="flex items-center w-50 py-2 px-8 bg-blue rounded-xl font-semibold text-white border-2 border-blue transition duration-150 ease-in hover:text-blue hover:bg-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="ml-2">Publicar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="hidden md:flex">
                <div class="border-r border-1 border-gray-400 mr-4 pr-4 flex flex-col items-center">
                    <div class="text-2xl text-green">22</div>
                    <button class="w-20 font-bold text-xs uppercase rounded-xl py-2 px-2 transition duration-150 ease-in border-2 border-green bg-white text-green hover:bg-green hover:text-white mt-2">Sim</button>
                </div>
                <div class="flex flex-col items-center">
                    <div class="font-semibold text-2xl text-red">12</div>
                    <button class="w-20 font-bold text-xs uppercase rounded-xl py-2 px-2 transition duration-150 ease-in border-2 border-red bg-white text-red hover:text-white hover:bg-red mt-2">Não</button>
                </div>
            </div>
        </div> <!-- END buttons-container -->

        <div class="comentarios-container relative space space-y-6 my-6 mt-1 pt-4">
            @for ($i = 0; $i < 30; $i++)
                @if(mt_rand(1,100) < 50)
                    <div
                        x-data="{isOpen: false}"
                        class="idea-container comentario-container relative bg-white rounded-xl flex justify-between px-4 py-6 md:ml-20 mt-6"
                    >
                        <div class="flex">
                            <div class="flex-none">
                                <a href="#">
                                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                                </a>
                            </div>
                            <div class="mx-4 flex flex-1 flex-col justify-between">
                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Delectus possimus, fuga velit ipsam beatae earum ad, vero cumque voluptates nihil, rem sint laudantium esse nobis laborum quasi repellat molestias! Deserunt molestias nulla, aliquam dignissimos debitis cumque ad tempora? Reprehenderit tempore, veritatis optio nobis placeat consequuntur. Error maiores tempore cupiditate esse pariatur odit eius cumque nesciunt quo debitis, delectus enim quod quasi eaque architecto reiciendis dolore ad, blanditiis, molestiae sit voluptate ut! Rem labore aliquid alias quia optio est officia minus cumque necessitatibus! Quidem commodi esse aliquid nesciunt! Libero dicta maiores culpa nobis quisquam nemo dignissimos corrupti, eos veniam quae consectetur.</p>

                                <div class="block md:hidden font-bold text-gray-900 mt-4">Keanu Reeves</div>
            
                                <div class="flex justify-between mt-4 md:mt-6 w-full flex-col items-start md:flex-row md:items-center">
                                    <div class="flex items-center text-gray-400 text-xs font-semibold space-x-2 mb-4">
                                        <div class="hidden md:block font-bold text-gray-900">Keanu Reeves</div>
                                        <div>&bull;</div>
                                        <div>10 horas atrás</div>
                                    </div>
                                    <div class="flex">
                                        <button
                                            x-on:click="isOpen = !isOpen"
                                            class="relative items-center font-bold text-xs text-gray-400 rounded-xl px-2 transition duration-150 ease-in bg-gray-200 hover:bg-gray-300"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                            </svg>
                                            <ul
                                                x-show="isOpen"
                                                class="absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3 text-black text-left z-10"
                                            >
                                                <li><a href="#" class="hover:bg-gray-100 block px-5 py-3 transition duration-150 ease-in">Marcar como spam</a></li>
                                                <li><a href="#" class="hover:bg-gray-100 block px-5 py-3 transition duration-150 ease-in text-red">Deletar ideia</a></li>
                                            </ul>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div 
                        x-data="{isOpen: false}"
                        class="idea-container comentario-container is-admin border-2 border-blue relative bg-white rounded-xl flex justify-between px-4 py-6 md:ml-20 mt-6"
                    >
                        <div class="flex flex-1">
                            <div class="flex-none">
                                <a href="#">
                                    <img src="https://source.unsplash.com/200x200/?face&crop=face&v=1" alt="avatar" class="w-14 h-14 rounded-xl">
                                </a>
                                
                                <div class="text-blue font-bold uppercase text-xs mt-2 w-full flex flex-col items-center">
                                    <span>Criador</span>
                                </div>
                            </div>
                            <div class="mx-4 flex flex-1 flex-col justify-between">
                                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Doloribus, assumenda minus. Natus laborum similique soluta. A modi dolorum tempore fugiat?</p>

                                <div class="block md:hidden font-bold text-blue mt-4">Keanu Reeves</div>
            
                                <div class="flex justify-between mt-4 md:mt-6 w-full flex-col items-start md:flex-row md:items-center">
                                    <div class="flex items-center text-gray-400 text-xs font-semibold space-x-2 mb-4 md:mb-0">
                                        <div class="hidden md:block font-bold text-blue">Keanu Reeves</div>
                                        <div>&bull;</div>
                                        <div>10 horas atrás</div>
                                    </div>
                                    <div class="flex">
                                        <button 
                                            x-on:click="isOpen = !isOpen"
                                            class="relative items-center font-bold text-xs text-gray-400 rounded-xl px-2 transition duration-150 ease-in bg-gray-200 hover:bg-gray-300"
                                        >
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                            </svg>
                                            <ul
                                                x-show="isOpen"
                                                class="absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3 text-black text-left z-10"
                                            >
                                                <li><a href="#" class="hover:bg-gray-100 block px-5 py-3 transition duration-150 ease-in">Marcar como spam</a></li>
                                                <li><a href="#" class="hover:bg-gray-100 block px-5 py-3 transition duration-150 ease-in text-red">Deletar ideia</a></li>
                                            </ul>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
        </div> <!-- END comentarios-container -->
    </div>
</x-app-layout>