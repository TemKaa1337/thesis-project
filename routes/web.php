<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'PageController@renderMainPage');
Route::get('/movie/{filmId}', 'PageController@renderFilmPage');
Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::get('/register', 'Auth\RegisterController@showRegistrationForm');

Auth::routes();

Route::get('logout', 'Auth\LoginController@logout');
Route::get('/admin/dashboard', 'PageController@renderAdminPage')->middleware(['auth', 'auth.admin']);

Route::post('/book/film', 'PageController@renderBookingPage')->middleware(['auth']);
Route::get('/cabinet', 'PageController@renderClientCabinetPage')->middleware(['auth']);
