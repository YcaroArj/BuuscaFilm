<?php

use App\Http\Controllers\MoviesController;
use Illuminate\Support\Facades\Route;

Route::controller(MoviesController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/movies/{movie}','show')->name('movies.show');
    Route::post('/movies/list-movies', 'filter')->name('movies.filter');
    Route::get('/movies/list','list')->name('movies.list');
});
