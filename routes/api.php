<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/get/filter/options', 'FilmController@getFilterOptions');
Route::post('/get/filter/movies', 'FilmController@getFilterMovies');
Route::post('/reset/filters', 'FilmController@resetFilmFilters');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
