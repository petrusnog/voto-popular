<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Voto Popular</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased text-gray-900 text-sm bg-gray-background">
        <header class="flex flex-col md:flex-row items-center justify-between px-8 py-4">
            <a href="{{route('idea.index')}}" class="w-40"><img class="object-cover" src="{{asset('img/voto-popular.png')}}" alt="Logo do site Voto Popular"></a>
            <div class="flex items-center mt-4 md:mt-0">
                @if (Route::has('login'))
                    <div class="px-6 py-4">
                        @auth
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <a class="text-sm text-gray-700 dark:text-gray-500 underline" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
                <a class="" href="#">
                    <img src="https://gravatar.com/avatar/00000?d=mp&f=y" alt="Avatar do usuário" class="w-10 h-10 rounded-full">
                </a>
            </div>
        </header>

        <main class="container mx-auto max-w-custom flex flex-col md:flex-row px-4" style="max-width: 1000px;">
            <div class="w-70 mx-auto md:mr-5">
                <div class="border-2 md:sticky md:top-8 rounded-xl md:mt-16 bg-white py-3 px-3">
                    <div class="text-center px-6 py-2 pt-6">
                        <h3 class="font-semibold text-base">Criar uma votação</h3>
                        <p class="text-xs mt-4">Você pode criar uma votação para qualquer coisa, o limite é a sua imaginação!</p>
                    </div>

                    <form action="#" method="POST" class="space-y-4 py-6">
                        <div>
                            <input type="text" name="title_add" class="w-full h-10 border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 placeholder:text-xs" placeholder="Título da votação">
                        </div>
                        <div>
                            <select name="category_add" class="w-full h-10 border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 text-xs">
                                <option value="">Categoria</option>
                                <option value="">Categoria</option>
                                <option value="">Categoria</option>
                            </select>
                        </div>
                        <div>
                            <textarea type="text" name="description_add" class="w-full h-40 resize-none border-none bg-gray-100 rounded-xl placeholder-gray-900 px-4 py-2 placeholder:text-xs" placeholder="Descreva a sua votação"></textarea>
                        </div>
                        <button type="submit" class="bg-blue text-white font-semibold w-full h-10 rounded-xl border-2 border-blue hover:bg-white hover:text-blue transition duration-150 ease-in flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="ml-2">Publicar</span>
                        </button>
                    </form>
                </div>
            </div>
            <div class="w-full px-4 md:px-0 md:w-175">
                <nav class="items-center justify-between text-xs hidden md:flex">
                    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3 space-x-10">
                        <li><a href="#" class="border-b-4 pb-3 border-blue">Todas as ideias (87)</a></li>
                        <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Em andamento (87)</a></li>
                    </ul>
                    <ul class="flex uppercase font-semibold space-x-10 border-b-4 pb-3 space-x-10">
                        <li><a href="#" class="border-b-4 pb-3 border-blue">Aprovadas (87)</a></li>
                        <li><a href="#" class="text-gray-400 transition duration-150 ease-in border-b-4 pb-3 hover:border-blue">Recusadas (87)</a></li>
                    </ul>
                </nav>

                <div class="mt-8">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </body>
</html>
