<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FilmController;
use Illuminate\Http\Request;
use App\UserBookedPlaces;
use App\Comments;
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
            $status = '';
            $bookedPlaces = [];
            $filmName = $filmData->getFilmNameById($film->film_id);
            $filmPlaces = json_decode($film->booked_places, true);

            foreach ($filmPlaces as $row => $places) {
                foreach ($places as $place) {
                    $placesCount += 1;
                    array_push($bookedPlaces, [
                        'row' => $row,
                        'place' => $place
                    ]);
                    $status = (fn() => date('Y-m-d H:i:s') < $film->datetime_shown)();
                }
            }

            array_push($result, [$filmName => [
                'placesCount' => $placesCount,
                'places' => $bookedPlaces,
                'cinema' => $film->cinema,
                'datetime_shown' => $film->datetime_shown,
                'status' => $status,
                'filmId' => $film->film_id
            ]]);
        }
        
        return $result;
    }

    public function submitUserComment(Request $request)
    {
        $comment = $request->post('comment');
        
        $newComment = Comments::create([
            'film_id' => $request->post('filmId'),
            'author' => Auth::user()->name.' '.Auth::user()->surname,
            'comment' => $request->post('comment'),
            'insert_datetime' => date('Y-m-d H:i')
        ]);
        
        $newCommentHtml = $this->getCommentHtml($newComment);

        return response()->json(array('result' => $newCommentHtml), 200);
    }

    public function getCommentHtml($newComment)
    {
        return "
            <hr></hr>
            <div class='comment_container'>
                <img src = ".asset('img/avatars/default_user_avatar.png')." alt='Avatar' style='width:90px'>
                <p><span >".Auth::user()->name.' '.Auth::user()->surname."</span>".$newComment->insert_datetime->format('d.m.Y')." в ".$newComment->insert_datetime->format('H:i')."</p>
                <p>".$newComment->comment."</p>
            </div>";
    }
}
