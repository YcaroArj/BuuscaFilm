@extends('layout.welcome')

@section('title', 'Catálogo')

@section('content')
    @if (count($popularMovies) > 0)
        <div class="flex justify-evenly flex-row flex-wrap p-8">
            @foreach ($popularMovies as $movie)
                <x-movie-card :movie="$movie" :genres="$genres" />
            @endforeach
        </div>
    @else
        <div class="flex items-center justify-center flex-col p-5 w-[100%] text-white">
            <h1 class="font-bold text-[50px]">Oops!</h1>
            <h1>Nenhum filme foi encontrado com os parâmetos enviados, por favor preencha novamente!</h1>
            <img class="h-[300px]" src="{{asset('assets/404_error.svg')}}" alt="">
        </div>
    @endif
@endsection
