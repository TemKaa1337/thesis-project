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
Route::post('/get/session/times', 'FilmController@getNewSessionTimes');
Route::post('/reset/filters', 'FilmController@resetFilmFilters');

Route::post('/book/places', [
    'uses' => 'BookController@bookChosenPlaces',
    'middleware' => 'auth:api'
]);

Route::post('/leave/comment', 'UserController@submitUserComment')->middleware('auth:api');
Route::post('/save/new_film', 'AdminController@saveNewFilm')->middleware('auth:api');
Route::post('/get/films/data', 'FilmController@getFilmsData')->middleware('auth:api');
Route::post('/get/cinema/data', 'FilmController@getCinemaData')->middleware('auth:api');
Route::post('/get/hall/data', 'FilmController@getHallData')->middleware('auth:api');
Route::post('/save/session/data', 'FilmController@saveSessionTime')->middleware('auth:api');
Route::post('/get/session/data', 'FilmController@getAllSessions')->middleware('auth:api');
Route::post('/remove/session/data', 'FilmController@removeSession')->middleware('auth:api');

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});
