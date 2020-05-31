<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\FilmController;
use App\Http\Controllers\UserController;
use App\SessionTime;
use App\Cinema;

class PageController extends Controller
{
    public function renderMainPage()
    {
        $films = new FilmController();
        $shownFilms = $films->getAllFilms();
        $slider = $films->getFilmsSlider();

        return view('main', ['films' => $shownFilms, 'sliders' => $slider]);
    }

    public function renderFilmPage($filmId)
    {
        $films = new FilmController();
        $filmDates = SessionTime::getSessionDates($filmId);
        $slider = $films->getFilmsSlider();
        $filmDescription = $films->getDetailedFilmDescription($filmId);
        $sessionDayNames = $films->getSessionDayNames($filmId, $filmDates);
        $sessionDayValues = $films->getSessionDayValues($filmId, $filmDates);
        $sessionTimes = $films->getSessionTimes($filmId, $filmDates);
        $comments = $films->getCommentsToFilm($filmId);
        
        return view('film_description', [
            'sliders' => $slider,
            'filmDescription' => $filmDescription,
            'sessionDayNames' => $sessionDayNames,
            'sessionDayValues' => $sessionDayValues,
            'sessionTimes' => $sessionTimes,
            'filmId' => $filmId,
            'comments' => $comments
        ]);
    }

    public function renderBookingPage(Request $request)
    {
        $films = new FilmController();
        $places = $films->getSessionPlaces($request->post('filmId'), $request->post('sessionTime'));
        $slider = $films->getFilmsSlider();
        
        return view('book_ticket', [
            'sliders' => $slider,
            'places' => (function () use ($places) {
                if (is_array($places)) {
                    return $places;
                } else {
                    $places = json_decode($places, true);
                    if (is_array($places))
                        return $places;
                    else
                        return json_decode($places, true);
                }
            })(),
            'filmId' => $request->post('filmId'),
            'sessionTime' => $request->post('sessionTime'),
            'cinema' => $request->post('cinema')
        ]);
    }

    public function renderClientCabinetPage()
    {
        $user = new UserController();
        $bookedPlaces = $user->getAllBookedPlaces();
        
        return view('user_cabinet', [
            'bookedPlaces' => $bookedPlaces
        ]);
    }

    public function renderAdminPage()
    {
        return view('admin_dashboard', [
            
        ]);
    }

    public function renderCinemaPage($cinemaId)
    {
        $films = new FilmController();
        $slider = $films->getFilmsSlider();
        $cinemaData = Cinema::where('id', $cinemaId)->get();
        
        return view('cinema_description', [
            'sliders' => $slider,
            'cinemaId' => $cinemaId,
            'cinemaData' => $cinemaData[0]
        ]);
    }

    public function renderAboutusPage()
    {
        $films = new FilmController();
        $slider = $films->getFilmsSlider();
        
        return view('about_us', [
            'sliders' => $slider
        ]);
    }
}
