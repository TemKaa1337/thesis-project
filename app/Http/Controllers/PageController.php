<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FilmController;

class PageController extends Controller
{
    public function renderMainPage()
    {
        $films = FilmController::getAllFilms();
        $slider = FilmController::getFilmsSlider();
        return view('main', ['films' => $films, 'sliders' => $slider]);
    }

    public function renderFilmPage($filmId)
    {
        $slider = FilmController::getFilmsSlider();
        $filmDescription = FilmController::getDetailedFilmDescription($filmId);
        return view('film_description', ['sliders' => $slider, 'filmDescription' => $filmDescription]);
    }
}
