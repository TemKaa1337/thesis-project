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
Route::post('/get/films/data', 'FilmController@getFilmsData')->middleware('auth:api');
Route::post('/get/cinema/data', 'FilmController@getCinemaData')->middleware('auth:api');
Route::post('/get/hall/data', 'FilmController@getHallData')->middleware('auth:api');
Route::post('save/user/wanted', 'UserController@saveUserWanted')->middleware('auth:api');

Route::post('/get/user/tickets', 'UserController@getAllTickets')->middleware('auth:api');
Route::post('/get/user/bonuses', 'UserController@getUserBonuses')->middleware('auth:api');
Route::post('/get/user/info', 'UserController@getUserInfo')->middleware('auth:api');
Route::post('/get/user/list', 'AdminController@getUsersList')->middleware('auth:api');

Route::post('/ban/user', 'AdminController@banUser')->middleware('auth:api');
Route::post('/delete/user', 'AdminController@deleteUser')->middleware('auth:api');

Route::post('/check/old/password', 'UserController@checkUserPassword')->middleware('auth:api');
Route::post('/save/new/user/credentials', 'UserController@saveNewUserCredentials')->middleware('auth:api');
Route::post('/save/film/info', 'FilmController@saveNewFilmInfo')->middleware('auth:api');

Route::post('/reset/filters', 'FilmController@resetFilmFilters');

Route::post('/book/places', [
    'uses' => 'BookController@bookChosenPlaces',
    'middleware' => 'auth:api'
]);

Route::post('/leave/comment', 'UserController@submitUserComment')->middleware('auth:api');
Route::post('/delete/comment', 'AdminController@makeAction')->middleware('auth:api');

Route::post('/save/new_film', 'AdminController@saveNewFilm')->middleware('auth:api');
Route::post('/save/session/data', 'FilmController@saveSessionTime')->middleware('auth:api');
Route::post('/get/session/data', 'FilmController@getAllSessions')->middleware('auth:api');
Route::post('/remove/session/data', 'FilmController@removeSession')->middleware('auth:api');
Route::post('/remove/user/ticket', 'BookController@unbookTicket')->middleware('auth:api');

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});
