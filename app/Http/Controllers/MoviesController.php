<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    public function index()
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/popular?language=pt-BR')
            ->json()['results'];

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?language=pt-BR')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        return view('template.catalog.app', [
            'popularMovies' => $popularMovies,
            'genres' => $genres,
        ]);
    }


    public function show($id)
    {
        $movie = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?language=pt-BR&append_to_response=credits,videos,images')
            ->json();

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?language=pt-BR')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        // dump($movie);

        return view(
            'template.description.app',
            [
                'movie' => $movie,
                'genres' => $genres,
            ]
        );
    }

    public function filter(Request $request)
    {
        $genre = $request->input('genre');
        $rating = $request->input('rating');  
        $certification = $request->input('certification');
    
        $ratingMin = $rating;
    
        $ratingMax = ($rating < 10) ? $rating + 1 : 10;
    
        return $this->list($genre, $rating, $certification, $ratingMin, $ratingMax);
    }

    public function list($genre, $ratingMin, $ratingMax, $certification)
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/discover/movie', [
                'language' => 'pt-BR',
                'with_genres' => $genre,
                'vote_average.gte' => $ratingMin, 
                'vote_average.lte' => $ratingMax,  
                'certification_country' => 'BR',
                'certification.lte' => $certification,
            ])
            ->json()['results'];

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?language=pt-BR')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        return view(
            'template.list.app',
            [
                'popularMovies' => $popularMovies,
                'genres' => $genres,
            ]
        );
    }
}
