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

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin/dashboard', function () {
    return 'NAISSSS';
})->middleware(['auth', 'auth.admin']);

Route::get('/book_ticket', function () {
    return view('book_ticket');
})->middleware(['auth', 'auth.registered']);
