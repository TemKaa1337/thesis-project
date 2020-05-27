<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Films;
use App\Slider;
use App\SessionTime;
use App\Comments;
use App\Cinema;

class FilmController extends Controller
{
    public function getAllFilms()
    {
        return Films::select('id', 'name', 'preview_image', 'genre')->where('is_shown', 1)->get();
    }

    public function getFilmsData(Request $request)
    {
        $filmsData = Films::select('id', 'name')->get();
        return response()->json(array('result' => $filmsData), 200);
    }

    public function getCinemaData(Request $request)
    {
        $cinemaData = Cinema::select('id', 'name')->get();
        return response()->json(array('result' => $cinemaData), 200);
    }

    public function getHallData(Request $request)
    {
        $cinemaData = Cinema::select('halls')->get();
        $hallNames = array_keys(json_decode($cinemaData[0]->halls, true));
        return response()->json(array('result' => $hallNames), 200);
    }

    public function getFilmsSlider()
    {
        return Slider::all();
    }

    private function getSessionDayName($sessionDay)
    {
        $sessionDay = date('N', strtotime($sessionDay));

        switch ($sessionDay) {
            case 1:
                return 'ПН';
            case 2:
                return 'ВТ';
            case 3:
                return 'СР';
            case 4:
                return 'ЧТ';
            case 5:
                return 'ПТ';
            case 6:
                return 'СБ';
            case 7:
                return 'ВС';
        }
    }

    public function getFilterOptions(Request $request)
    {
        switch ($request->post('parameter')) {
            case 'date_shown':
                $result = SessionTime::select('date_shown')->distinct('date_shown')->where([
                    ['date_shown', '<=', date('Y-m-d', strtotime(date('Y-m-d').' +7 days'))],
                    ['date_shown', '>=', date('Y-m-d')]
                ])->get();

                $formattedHtml = $this->formatFilterOptionsToHtml($result, 'date_shown');
                return response()->json(array('result' => $formattedHtml), 200);
                break;
            case 'genre':
                $result = Films::select('genre')->distinct('genre')->get();
                $formattedHtml = $this->formatFilterOptionsToHtml($result, 'genre');
                break;
            case 'cinema':
                $result = SessionTime::select('cinema_name')->distinct('cinema_name')->where([
                    ['date_shown', '<=', date('Y-m-d', strtotime(date('Y-m-d').' +7 days'))],
                    ['date_shown', '>=', date('Y-m-d')]
                ])->get();

                $formattedHtml = $this->formatFilterOptionsToHtml($result, 'cinema_name');
                break;
        }

        return response()->json(array('result' => $formattedHtml), 200);
    }

    public function getFilterMovies(Request $request)
    {
        $parameterName = $request->post('paramName');
        $parameterValue = $request->post('paramValue');

        if ($parameterName == 'genre') {
            $films = Films::select('id', 'name', 'preview_image', 'genre')->where([
                [$parameterName, $parameterValue],
                ['is_shown', '=', 1]
            ])->get();
        } else if ($parameterName == 'date_shown') {
            $films = Films::select('id', 'name', 'preview_image', 'genre')->where([
                ['date_shown_from', '<=', date('Y-m-d', strtotime($parameterValue))],
                ['date_shown_to', '>=', date('Y-m-d', strtotime($parameterValue))],
                ['is_shown', 1]
            ])->get();
        } else if ($parameterName == 'cinema') {
            $result = SessionTime::select('film_id')->distinct('film_id')->where([
                ['date_shown', '<=', date('Y-m-d', strtotime(date('Y-m-d').' +7 days'))],
                ['date_shown', '>=', date('Y-m-d')],
                ['cinema_name', '=', $parameterValue]
            ])->get();

            $filmIds = (function () use ($result) {
                $filmIds = [];
                foreach ($result as $film) {
                    array_push($filmIds, $film->film_id);
                }

                return $filmIds;
            })();
            
            $films = Films::select('id', 'name', 'preview_image', 'genre')->where([
                ['is_shown', '=', 1]
            ])->whereIn('id', $filmIds)->get();
        }
        $formattedHtml = $this->formatFilmsToHtml($films);

        return response()->json(array('result' => $formattedHtml), 200);
    }

    public function resetFilmFilters(Request $request)
    {
        $films = Films::select('id', 'name', 'preview_image', 'genre')->get();
        $formattedHtml = $this->formatFilmsToHtml($films);

        return response()->json(array('result' => $formattedHtml), 200);
    }

    public function formatFilterOptionsToHtml($data, $parameter)
    {
        $resultHtml = '<option disabled selected value>Выберите параметр</option>';

        if ($parameter == 'date_shown') {
            foreach ($data as $option) {
                $resultHtml .= "<option value = ".$option->$parameter.">".$option->$parameter->format('d.m.Y')."</option>";
            }
        } else {
            foreach ($data as $option) {
                $resultHtml .= "<option value = ".$option->$parameter.">".$option->$parameter."</option>";
            }
        }
        
        return $resultHtml;
    }

    public function formatFilmsToHtml($films)
    {
        $html = '';

        foreach ($films as $film) {
            $html .= "
            <div class = 'event'>
                <p class = 'film_name'>".$film->name."</p>
                <img class = 'film_image_name' src = '".asset($film->preview_image)."'></img>
                <div class = 'short_film_description'>
                    <p>Жанр: ".$film->genre."</p>
                    <a class = 'button' href = '".url('/movie/'.$film->id)."' >Смотреть описание</a>
                </div>
            </div>";
        }

        return $html;
    }

    public function getDetailedFilmDescription($filmId)
    {
        $filmDescription = Films::where('id', $filmId)->get();
        return $filmDescription[0];
    }

    public function getSessionDayNames($filmId, $filmSessionDays)
    {
        $filmDayNames = [];

        foreach ($filmSessionDays as $day) {
            array_push($filmDayNames, $this->getSessionDayName($day->date_shown));
        }

        return $filmDayNames;
    }

    public function getSessionDayValues($filmId, $filmSessionDays)
    {
        $filmDayValues = [];
        
        foreach ($filmSessionDays as $day) {
            array_push($filmDayValues, $day->date_shown);
        }

        return $filmDayValues;
    }

    public function getSessionTimes($filmId, $filmSessionDays)
    {
        $result = [];
        if (!$filmSessionDays->isEmpty()) {
            $sessions = SessionTime::select('cinema_name', 'datetime_shown', 'cinema_id')->where([
                ['film_id', '=', $filmId],
                ['date_shown', '=', $filmSessionDays[0]->date_shown]
            ])->get();

            foreach ($sessions as $session) {
                if (array_key_exists($session->cinema_name, $result)) {
                    array_push($result[$session->cinema_name]['sessions'], $session->datetime_shown);
                } else {
                    $result[$session->cinema_name]['sessions'] = [$session->datetime_shown];
                }

                $result[$session->cinema_name]['cinemaId'] = 'cinema/'.$session->cinema_id;
            }

            return $result;
        } else return [];
    }

    public function getSessionPlaces($filmId, $sessionTime)
    {
        return SessionTime::select('hall_places')->where([
            ['film_id', $filmId],
            ['datetime_shown', $sessionTime]
        ])->get()[0]->hall_places;
    }

    public function getNewSessionTimes(Request $request)
    {
        $result = [];
        $token = $request->post('_token');
        $sessionDate = $request->post('sessionDate');
        $filmId = $request->post('filmId');
        
        $newSessionData = SessionTime::select('cinema_name', 'datetime_shown', 'cinema_id')->where([
            ['date_shown', $sessionDate],
            ['film_id', $filmId]
        ])->get();

        foreach ($newSessionData as $session) {
            if (array_key_exists($session->cinema_name, $result)) {
                array_push($result[$session->cinema_name]['dates'], $session->datetime_shown);
            } else {
                $result[$session->cinema_name] = ['dates' => [$session->datetime_shown], 'cinemaUrl' => 'cinema/'.$session->cinema_id];
            }
        }
        
        return $this->formatSessionTimesToHtml($filmId, $sessionDate, $result, $token);
    }

    public function formatSessionTimesToHtml($filmId, $sessionDate, $newSessionData, $token)
    {
        $html = '<tbody>';

        foreach ($newSessionData as $cinema => $sessions) {
            $html .= "<tr><td><a href = ".url($sessions['cinemaUrl'])." >Кинотеатр $cinema:</a></td>";
            
            foreach ($sessions['dates'] as $session) {
                $html .= "
                <td>
                    <form action = ".url('book/film')." method = 'POST'>
                        <input type = 'hidden' name = '_token' value = ".$token.">
                        <input type = 'hidden' name = 'filmId' value = ".$filmId.">
                        <input type = 'hidden' name = 'sessionTime' value = '".$session->format('Y-m-d H:i:s')."'>
                        <button type = 'submit' data-cinema = ".$cinema." class = 'session_time'>".$session->format('H:i')."</button>
                    </form>
                </td>";
            }
            $html .= '</tr>';
        }
        $html .= '</tbody>';

        return response()->json(array('result' => $html), 200);
    }

    public function getFilmNameById($filmId)
    {
        return Films::select('name')->where('id', $filmId)->get()[0]->name;
    }

    public function getCommentsToFilm($filmId)
    {
        return Comments::where('film_id', $filmId)->get();
    }

    public function saveSessionTime(Request $request)
    {
        $hallPlaces = Cinema::select('halls')->get()[0]->halls;
        $halls = json_encode(json_decode($hallPlaces, true)[$request->hallName]);
        
        SessionTime::create([
            'film_id' => $request->filmId,
            'date_shown' => date('Y-m-d', strtotime($request->datetimeShown)),
            'datetime_shown' => date('Y-m-d H:i:s', strtotime($request->datetimeShown)),
            'cinema_name' => Cinema::where('id', $request->cinemaId)->get()[0]->name,
            'cinema_id' => $request->cinemaId,
            'hall_places' => $halls
        ]);
        
        return response()->json(array('result' => 1), 200);
    }

    public function getAllSessions(Request $request)
    {
        $html = '';
        $sessions = SessionTime::select('id', 'datetime_shown', 'film_id', 'cinema_name')->where('datetime_shown', '>=', date('Y-m-d H:i:s'))->orderBy('datetime_shown', 'asc')->get();
        
        foreach ($sessions as $session) {
            $html .= "
                <div class = 'sessions_to_remove'>
                    <div>
                        <span class = 'dropdown'>
                            <select id = 'session_time' class = 'film_filter_select'>
                                <option disabled selected value>".$session->datetime_shown->format('d.m.Y H:i')."</option>
                            </select>
                        </span>
                    </div>
                    <div>
                        <span id = 'cinema_span' class = 'dropdown'>
                            <select id = 'cinema' class = 'film_filter_select'>
                                <option disabled selected value>".Films::where('id', $session->film_id)->get()[0]->name."</option>
                            </select>
                        </span>
                    </div>
                    <div>
                        <span id = 'hall_span' class = 'dropdown'>
                            <select id = 'hall' class = 'film_filter_select'>
                                <option disabled selected value>Кинотеатр ".$session->cinema_name."</option>
                            </select>
                        </span>
                    </div>
                    <div>
                        <a data-session = ".$session->id." class = 'remove_button'>Удалить сеанс</a>
                    </div>
                </div>";
        }
        

        return response()->json(array('result' => $html), 200);
    }

    public function removeSession(Request $request)
    {
        SessionTime::where('id', $request->sessionId)->delete();
        return $this->getAllSessions($request);
    }
}
