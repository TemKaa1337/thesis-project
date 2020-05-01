<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Films;
use App\Slider;
use App\SessionTime;

class FilmController extends Controller
{
    public static function getAllFilms()
    {
        return Films::select('id', 'name', 'preview_image', 'genre')->where('is_shown', 1)->get();
    }

    public static function getFilmsSlider()
    {
        return Slider::all();
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

    public static function getDetailedFilmDescription($filmId)
    {
        $filmDescription = Films::where('id', $filmId)->get();
        return $filmDescription[0];
    }
}
