<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Films;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function saveNewFilm(Request $request)
    {
        $previewImage = Str::random(20).'.jpg';
        $mainImage = Str::random(20).'.jpg';
        
        Storage::disk('file_uploads')->putFileAs('//film_previews//', $request->previewImage, $previewImage);
        Storage::disk('file_uploads')->putFileAs('//film_page//', $request->filmPageImage, $mainImage);

        $newFilm = Films::create([
            'name' => $request->filmName,
            'preview_image' => 'img/film_previews/'.$previewImage,
            'film_page_image' => 'img/film_page/'.$mainImage,
            'description' => $request->filmDescription,
            'genre' => $request->genre,
            'date_shown_from' => $request->dateFrom,
            'date_shown_to' => $request->dateTo,
            'country' => $request->country,
            'year' => $request->year,
            'producer' => $request->producer,
            'duration' => $request->filmLength.' минут',
            'actors' => $request->actors,
            'age_restriction' => $request->ageRestrictions.'+',
            'trailer' => $request->trailer,
            'is_shown' => 1
        ]);

        return response()->json(array('result' => 1), 200);
    }
}
