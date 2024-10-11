<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoviesController extends Controller
{
    protected $movieGenre;
    protected $lancamento;

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
            ->get('https://api.themoviedb.org/3/movie/' . $id . '?language=pt-BR&append_to_response=credits,videos,images,release_dates')
            ->json();
    
        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?language=pt-BR')
            ->json()['genres'];
    
        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });
    
        foreach ($movie['release_dates']['results'] as $country) {
            if ($country['iso_3166_1'] == 'BR') {  
                foreach ($country['release_dates'] as $release) {
                    if (isset($release['certification'])) {
                        $rating = $release['certification'];  
                        break 2;  
                    }
                }
            }
        }

        return view(
            'template.description.app',
            [
                'movie' => $movie,
                'genres' => $genres,
                'rating' => $rating,  // Passa a classificação para a view
            ]
        );
    }

    public function filter(Request $request)
    {
        $genre = $request->input('genre');
        $rating = $request->input('rating');
        $this->lancamento = $request->input('lancamento');

        return $this->list($genre, $rating);
    }

    public function list($genre, $ratingMin)
    {
        $popularMovies = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/discover/movie', [
                'language' => 'pt-BR',
                'with_genres' => $genre,
                'vote_average' => $ratingMin,
                'certification_country' => 'BR',
                'primary_release_year' => $this->lancamento,
                'sort_by' => 'popularity.desc',
                'certification_country' => 'BR',
                'certification.lte' => '18',
            ])
            ->json()['results'];

        $genresArray = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/genre/movie/list?language=pt-BR')
            ->json()['genres'];

        $genres = collect($genresArray)->mapWithKeys(function ($genre) {
            return [$genre['id'] => $genre['name']];
        });

        switch ($genre) {
            case 28:
                $this->movieGenre = "Filmes de Ação";
                break;
            case 12:
                $this->movieGenre = "Filmes de Aventura";
                break;
            case 16:
                $this->movieGenre = "Filmes de Animação";
                break;
            case 35:
                $this->movieGenre = "Filmes de Comédia";
                break;
            case 18:
                $this->movieGenre = "Filmes de Drama";
                break;
            case 878:
                $this->movieGenre = "Filmes de Ficção científica";
                break;
            case 10749:
                $this->movieGenre = "Filmes de Romance";
                break;
            case 27:
                $this->movieGenre = "Filmes de Terror";
                break;
            case 14:
                $this->movieGenre = "Filmes de Fantasia";
                break;
            default:
                $this->movieGenre = "Filmes populares";
                break;
        }


        return view(
            'template.list.app',
            [
                'popularMovies' => $popularMovies,
                'genres' => $genres,
                'movieGenre' => $this->movieGenre,
            ]
        );
    }
}
