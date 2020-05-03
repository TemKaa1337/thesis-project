<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SessionTime;
use App\UserBookedPlaces;
use App\Http\Controllers\SessionController;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function bookChosenPlaces(Request $request)
    {
        if ($request->post('places') == NULL)
            return response()->json(array('result' => ''), 200);

        $placesSchema = SessionTime::select('hall_places')->where([
            ['film_id', $request->post('filmId')],
            ['datetime_shown', $request->post('datetime')],
            ['cinema_name', $request->post('cinema')]
        ])->get();
        
        $placesSchema = json_decode($placesSchema[0]->hall_places, true);
        $this->bookPlacesForUser($placesSchema, $request);

        return response()->json(array('result' => 1), 200);
    }

    public function bookPlacesForUser($placesSchema, $request)
    {
        $places = [];

        foreach ($request->post('places') as $place) {
            $row = (int)$place['placeRow'];
            $place = (int)$place['placeNumber'];

            if (isset($placesSchema[$row][$place]) && $placesSchema[$row][$place] == 0) {
                if (isset($places[$row])) {
                    array_push($places[$row], $place);
                } else {
                    $places[$row] = [$place];
                }
            }
        }
        
        UserBookedPlaces::insert([
            'film_id' => $request->post('filmId'),
            'user_id' => Auth::user()->id,
            'datetime_shown' => $request->post('datetime'),
            'cinema' => $request->post('cinema'),
            'booked_places' => json_encode($places)
        ]);

        $this->updateBookedPlaces($places, $request);
    }

    public function updateBookedPlaces($bookedPlaces, $request)
    {
        $allPlaces = SessionTime::select('hall_places')->where([
            ['film_id', $request->post('filmId')],
            ['datetime_shown', $request->post('datetime')],
            ['cinema_name', $request->post('cinema')]
        ])->get()[0]->hall_places;
        $allPlaces = json_decode($allPlaces, true);

        foreach ($bookedPlaces as $row => $places) {
            foreach ($places as $place) {
                $allPlaces[$row][$place] = 1;
            }
        }
        
        SessionTime::where([
            ['film_id', $request->post('filmId')],
            ['datetime_shown', $request->post('datetime')],
            ['cinema_name', $request->post('cinema')]
        ])->update(['hall_places' => json_encode($allPlaces)]);
    }
}
