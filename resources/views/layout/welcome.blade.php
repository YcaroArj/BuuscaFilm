<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>BuuscaFilm - @yield('title')</title>
</head>

<body>
    <nav class="bg-navbar_background w-[360px] p-8 max-desktop:w-full">
        <div class="flex justify-center max-desktop:justify-between">
            <a href="{{ route('home') }}" class="text-primary text-center text-2xl font-bold ">BuuscaFilm</a>
            <div class="hidden max-desktop:block">
                <button id="menu-btn" class="text-white focus:outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
        <div class="menu mt-10" id="mobile-menu">
            <form class="flex flex-col" action="{{ route('movies.filter') }}" method="POST">
                @csrf
                <label for="genre" class="text-primary text-xl mb-1">Categoria</label>
                <select name="genre" id="genre" class="h-[30px] bg-gray-400 rounded mb-5 focus:outline-none ">
                    <option value="" disabled selected>Selecione a categoria</option>
                    <option value="28">Ação</option>
                    <option value="12">Aventura</option>
                    <option value="16">Animação</option>
                    <option value="35">Comédia</option>
                    <option value="18">Drama</option>
                    <option value="878">Ficção científica</option>
                    <option value="10749">Romance</option>
                    <option value="27">Terror</option>
                    <option value="14">Fantasia</option>
                </select>

                <label for="rating" class="text-primary text-xl">Avaliação</label>
                <select name="rating" id="rating" class="h-[30px] bg-gray-400 rounded mb-5 focus:outline-none ">
                    <option value="" disabled selected>Selecione a avaliação</option>
                    <option value="1">⭐10%</option>
                    <option value="2">⭐20%</option>
                    <option value="3">⭐30%</option>
                    <option value="4">⭐40%</option>
                    <option value="5">⭐50%</option>
                    <option value="6">⭐60%</option>
                    <option value="7">⭐70%</option>
                    <option value="8">⭐80%</option>
                    <option value="9">⭐90%</option>
                    <option value="10">⭐100%</option>
                </select>

                <label for="lancamento" class="text-primary text-xl">Ano de lançamento</label>
                <input name="lancamento" id="lancamento"
                class="h-[30px] bg-gray-400 rounded mb-5 focus:outline-none pl-2 placeholder-black" placeholder="Digite o ano de lançamento">

                <button type="submit"
                    class="h-[33px] w-[100%] bg-gradient-to-r from-primary to-secondary rounded text-white">Buscar</button>
            </form>
        </div>
    </nav>
    <main class="flex flex-wrap bg-black w-[100%] overflow-auto">
        @yield('content')
    </main>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>

</html>
