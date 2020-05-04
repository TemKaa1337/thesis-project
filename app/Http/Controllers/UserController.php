<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FilmController;
use Illuminate\Http\Request;
use App\UserBookedPlaces;
use Auth;

class UserController extends Controller
{
    public function getAllBookedPlaces()
    {
        $result = [];
        $placesCount = 0;
        $filmData = new FilmController();
        $bookedFilms = UserBookedPlaces::where('user_id', Auth::user()->id)->orderBy('datetime_shown', 'desc')->get();

        foreach ($bookedFilms as $film) {
            $placesCount = 0;
            $bookedPlaces = [];
            $filmName = $filmData->getFilmNameById($film->film_id);
            $filmPlaces = json_decode($film->booked_places, true);

            foreach ($filmPlaces as $row => $places) {
                foreach ($places as $place) {
                    $placesCount += 1;
                    array_push($bookedPlaces, [
                        'row' => $row,
                        'place' => $place, 
                        'status' => (fn() => date('Y-m-d H:i:s') < $film->datetime_shown)()
                    ]);
                }
            }

            array_push($result, [$filmName => [
                'placesCount' => $placesCount,
                'places' => $bookedPlaces,
                'cinema' => $film->cinema,
                'datetime_shown' => $film->datetime_shown
            ]]);
        }
        
        return $result;
    }
}
