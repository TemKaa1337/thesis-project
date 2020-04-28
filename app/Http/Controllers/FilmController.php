<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Films;

class FilmController extends Controller
{
    public static function getAllFilms()
    {
        return Films::select('id', 'name', 'preview_image', 'genre')->where('is_shown', 1)->get();
    }

    public function getFilterOptions(Request $request)
    {
        switch ($request->post('parameter')) {
            case 'date_shown':
                return response()->json(array('result' => 'date_shown'), 200);
                break;
            case 'genre':
                $data = Films::select('genre')->distinct('genre')->get();
                $formattedHtml = $this->formatFilterOptionsToHtml($data, 'genre');
                break;
            case 'cinema':
                return response()->json(array('result' => 'cinema'), 200);
                break;
        }

        return response()->json(array('result' => $formattedHtml), 200);
    }

    public function getFilterMovies(Request $request)
    {
        $parameterName = $request->post('paramName');
        $parameterValue = $request->post('paramValue');

        $films = Films::select('id', 'name', 'preview_image', 'genre')->where($parameterName, $parameterValue)->get();
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

        foreach ($data as $option) {
            $resultHtml .= "<option value = ".$option->$parameter.">".$option->$parameter."</option>";
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
}
