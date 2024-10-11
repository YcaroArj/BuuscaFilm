<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MovieInfoController extends Controller
{
    public function index()
    {
        return view('template.movie_info.app');
    }

    public function getMovies()
    {
     
    }
}
