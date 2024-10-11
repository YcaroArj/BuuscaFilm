@extends('layout.welcome')

@section('title', 'Descrição')

@section('content')
    <div class="flex flex-col w-full">
        <div class="relative h-auto bg-cover bg-center"
            style="background-image: linear-gradient(to right, 
            rgba(31.5, 10.5, 10.5, 1) calc((50vw - 170px) - 340px), 
            rgba(31.5, 10.5, 10.5, 0.84) 50%, rgba(31.5, 10.5, 10.5, 0.84) 100%), 
            url('{{ 'https://image.tmdb.org/t/p/original/' . $movie['backdrop_path'] }}');">
            <div class="absolute inset-0 bg-black opacity-50"></div>
            <div class="relative z-10 mx-20 mt-5 mb-5 flex flex-row overflow-auto max-md:flex-wrap max-tablet:flex-col max-phone:items-center max-tablet:mx-5 ">
                <img class="h-[500px] pr-[40px] max-tablet:w-[350px] max-tablet:pr-0" src="{{ 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'] }}"
                    alt="cartaz">
                <div class="text-white w-[50vw] max-tablet:w-full">
                    <div class="mb-[30px]">
                        <h1 class="text-3xl font-bold mt-2">
                            {{ $movie['title'] }} ({{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }})
                        </h1>
                        <span>⭐{{ floor($movie['vote_average'] * 10) . '%' }}</span>
                        <span>|</span>
                        <span>
                            @foreach ($movie['genres'] as $genre)
                                {{ $genre['name'] }} @if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </span>
                        <span>|</span>
                        <span>{{ floor($movie['runtime'] / 60) }}h {{ $movie['runtime'] % 60 }}min</span>
                    </div>
                    <div>
                        <h1 class="text-2xl">Sinopse</h1>
                        <p class="mt-[10px]">{{ $movie['overview'] }}</p>
                    </div>
                    <div class="flex flex-row  mt-20 text-white flex-wrap">
                        @foreach ($movie['credits']['crew'] as $crew)
                            @if ($loop->index < 3)
                                <div class="mr-20 mb-5">
                                    <div>{{ $crew['name'] }}</div>
                                    <div class="text-sm text-gray-400">{{ $crew['job'] }}</div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="h-full bg-white px-20 py-5 flex flex-col">
            <h1 class="text-2xl" >Elenco principal</h1>
            <div class="flex flex-row overflow-auto py-5 scrollbar-thin">
                @foreach ($movie['credits']['cast'] as $cast)
                    @if ($loop->index < 15)
                        <div class="w-[150px] border rounded flex-shrink-0 flex flex-col items-center mr-4">
                            <img class="h-[225px] w-[150px] object-cover"
                                src="{{ 'https://image.tmdb.org/t/p/w500/' . $cast['profile_path'] }}"
                                alt="Foto do ator/atriz">
                            <div class="h-full p-[10px] text-center">
                                <h1 class="font-bold text-sm">{{ $cast['name'] }}</h1>
                                <p class="font-light">{{ $cast['character'] }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

        </div>
    </div>

@endsection
