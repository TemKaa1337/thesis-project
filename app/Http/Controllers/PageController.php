<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FilmController;

class PageController extends Controller
{
    public function renderMainPage()
    {
        $films = FilmController::getAllFilms();
        return view('main', ['filmData' => $films]);
    }

    public function renderFilmPage($filmId)
    {
        return view('film_description');
    }
}
