<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserBookedPlaces;
use Auth;

class UserController extends Controller
{
    public function getAllBookedPlaces()
    {
        $result = [];
        $bookedFilms = UserBookedPlaces::where('user_id', Auth::user()->id)->get();

        foreach ($bookedFilms as $film) {
            $places = json_decode($film->booked_places, true);
            dd(count($places));
            // array_push($result, [
            //     ''
            // ]);
        }
    }
}
