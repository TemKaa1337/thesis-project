<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SessionTime;
use App\UserBookedPlaces;
use App\UserBonuses;
use App\Bonuses;
use App\Films;
use App\Http\Controllers\SessionController;
use Auth;

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
        
        if (is_array($placesSchema[0]->hall_places)) {
            $placesSchema = $placesSchema[0]->hall_places;
        } else {
            $placesSchema = json_decode($placesSchema[0]->hall_places, true);
        }
        
        $result = $this->bookPlacesForUser($placesSchema, $request);
        $this->giveUserBonuses();

        return response()->json(array('result' => $result), 200);
    }

    public function bookPlacesForUser($placesSchema, $request)
    {
        $places = [];
        
        $userBookedPlaces = UserBookedPlaces::where([
            ['film_id', $request->post('filmId')],
            ['user_id', Auth::user()->id],
            ['datetime_shown', $request->post('datetime')],
            ['cinema', $request->post('cinema')]
        ])->get();

        if ($userBookedPlaces->isEmpty()) {
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
                'booked_places' => json_encode($places),
                'attempt' => 1
            ]);

            $this->updateBookedPlaces($places, $request);
        } else {
            if (is_array($userBookedPlaces[0]->booked_places)) {
                $userBookedPlaces = $userBookedPlaces[0]->booked_places;
            } else {
                $userBookedPlaces = json_decode($userBookedPlaces[0]->booked_places, true);
            }
            
            $placesCount = $this->getBookedPlacesCount($userBookedPlaces);

            if ($placesCount == 5) 
                return 'Места не были забронированы. На один сеанс можно забронировать максимум 5 мест!';

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

                $placesCount += 1;
                if ($placesCount == 5)
                    break;
            }

            foreach ($places as $row => $place) {
                foreach ($place as $singlePlace) {
                    if (isset($userBookedPlaces[$row])) {
                        if (is_array($userBookedPlaces[$row])) {
                            array_push($userBookedPlaces[$row], $singlePlace);
                        } else {
                            $tempPlace = $userBookedPlaces[$row];
                            $userBookedPlaces[$row] = [$tempPlace, $singlePlace];
                        }
                    } else {
                        $userBookedPlaces[$row] = [$singlePlace];
                    }
                }
            }

            UserBookedPlaces::where([
                'film_id' => $request->post('filmId'),
                'user_id' => Auth::user()->id,
                'datetime_shown' => $request->post('datetime'),
                'cinema' => $request->post('cinema')
            ])->update(['booked_places' => json_encode($userBookedPlaces)]);

            UserBookedPlaces::where([
                'film_id' => $request->post('filmId'),
                'user_id' => Auth::user()->id,
                'datetime_shown' => $request->post('datetime'),
                'cinema' => $request->post('cinema')
            ])->increment('attempt', 1);

            $this->updateBookedPlaces($userBookedPlaces, $request);
        }

        return 'Места успешно забронированы! \n Забронированные места вы можете посмотреть в личном кабинете.';
    }

    public function updateBookedPlaces($bookedPlaces, $request)
    {
        $allPlaces = SessionTime::select('hall_places')->where([
            ['film_id', $request->post('filmId')],
            ['datetime_shown', $request->post('datetime')],
            ['cinema_name', $request->post('cinema')]
        ])->get()[0]->hall_places;

        if (!is_array($allPlaces)) {
            $allPlaces = json_decode($allPlaces, true);
        }
        
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

    public function getBookedPlacesCount($bookedPlaces)
    {
        $count = 0;

        foreach ($bookedPlaces as $row => $places) {
            foreach ($places as $place) {
                $count += 1;
            }
        }

        return $count;
    }

    public function giveUserBonuses()
    {
        $placesCount = 0;
        $places = UserBookedPlaces::select('booked_places', 'attempt')->where('user_id', Auth::user()->id)->get();
        
        foreach ($places as $place) {
            $userPlaces = json_decode($place->booked_places, true);
            $placesCount += $place->attempt;
        }
        
        $balance = $placesCount % 10;
        if ($placesCount == 1 || $balance == 0) {
            $bonusNumber = random_int(0, 1);
            $newUserBonusId = Bonuses::select('id', 'days_active')->get()[$bonusNumber];

            UserBonuses::insert([
                'user_id' => Auth::user()->id,
                'bonus_id' => $newUserBonusId->id,
                'expires_at' => date('Y-m-d', strtotime('+ '.$newUserBonusId->days_active.' day'))
            ]);
        }
    }

    public function unbookTicket(Request $request)
    {
        $user = new UserController();
        $this->removeUserPlace($request);
        $this->removeSessionPlace($request);

        return $this->getAllTickets($request);
    }

    public function removeUserPlace($request)
    {
        // dd($request->all());
        $userPlaces = json_decode(UserBookedPlaces::select('booked_places')->where([
            ['user_id', Auth::user()->id],
            ['cinema' => $request->cinemaName],
            ['datetime_shown' => $request->date],
            ['film_id' => Films::select('id')->where('name', $request->filmName)->get()[0]->id]
        ])->get()[0]->booked_places, true);
        dd($userPlaces);
    }

    public function removeSessionPlace($request)
    {
        
    }
}
