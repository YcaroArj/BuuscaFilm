@extends('layout.welcome')

@section('title', 'Catálogo')

@section('content')
    <div class="flex justify-evenly flex-row flex-wrap p-8">
        @foreach ($popularMovies as $movie)
            <x-movie-card :movie="$movie" :genres="$genres" />
        @endforeach
    </div>

@endsection
