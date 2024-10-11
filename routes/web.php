<?php

use App\Http\Controllers\GetApiController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->group(base_path('routes/local/MoviesController.php'));
