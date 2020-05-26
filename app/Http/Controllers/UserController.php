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
        $newComment = Comments::create([
            'film_id' => $request->post('filmId'),
            'author' => Auth::user()->name.' '.Auth::user()->surname,
            'comment' => $request->post('comment'),
            'insert_datetime' => date('Y-m-d H:i'),
            'user_id' => Auth::user()->id,
            'avatar' => Auth::user()->user_image
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

    public function getAllTickets(Request $request)
    {
        $html = '';
        $bookedPlaces = $this->getAllBookedPlaces();
        
        foreach ($bookedPlaces as $sessions) {
            $html .= "<div class = 'ticket_item'>";
            foreach ($sessions as $filmName => $filmInfo) {
                $html .= "
                    <div>
                        <p>".$filmName."</p>
                    </div>
                    <div>
                        <p>".$filmInfo['datetime_shown']."</p>
                    </div>
                    <div>
                        <p>Мест: ".$filmInfo['placesCount']."</p>
                    </div>
                    <div>
                ";

                if ($filmInfo['status'])
                    $html .= "<p class = 'film_active'>Активен</p></div>";
                else
                    $html .= "<p class = 'film_disabled'>Не активен</p></div>";

                foreach ($filmInfo['places'] as $places) {
                    $html .= "
                        <div>
                            <p>Кинотеатр: ".$filmInfo['cinema']."</p>
                        </div>
                        <div>
                            <p>Ряд: ".$places['row']."</p>
                        </div>
                        <div>
                            <p>Место: ".$places['place']."</p>
                        </div>
                        <div style = 'text-align: center;'>
                            <a id = 'unbook_button' class = 'unbook_button' data-film = '". $filmName ."' data-date = '".$filmInfo['datetime_shown']."' data-place = '".$places['place']."' data-row = '".$places['row']."' data-cinema = '".$filmInfo['cinema']."'>Снять бронь</a>
                        </div>
                    ";
                }
            }
            $html .= "</div>";
        }

        return response()->json(array('result' => $html), 200);
    }

    public function getUserBonuses(Request $request)
    {
        $userBonuses = UserBonuses::where('user_id', Auth::user()->id)->get();
        return response()->json(array('result' => ''), 200);
    }

    public function getUserInfo(Request $request)
    {
        return response()->json(array('result' => ''), 200);
    }
}
