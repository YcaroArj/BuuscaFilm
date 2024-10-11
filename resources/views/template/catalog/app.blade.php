@extends('layout.welcome')

@section('title', 'Catálogo')

@section('content')
<div class="p-8">
    <h1 class="text-2xl text-white mb-8">Filmes populares</h1>
    <div class="flex justify-evenly flex-row flex-wrap">
        @foreach ($popularMovies as $movie)
            <x-movie-card :movie="$movie" :genres="$genres" />
        @endforeach
    </div>
</div>

@endsection
