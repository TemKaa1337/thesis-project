<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FilmController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\UserBookedPlaces;
use App\UserBonuses;
use App\UserNotifications;
use App\Bonuses;
use App\Comments;
use App\Films;
use App\User;
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
        if (isset($userBonuses[0])) {
            $html = '';

            foreach ($userBonuses as $bonus) {
                $html .= "
                    <div class = 'ticket_item' style = 'grid-template-columns: 1fr 1fr 1fr'>
                            <div>
                                <p>".$bonus->bonus->name."</p>
                            </div>
                            <div>
                                <p>Бонус действителен до ".$bonus->expires_at->format('d.m.Y H:i')."</p>
                            </div>
                            <div>
                                ".(function () use ($bonus) {
                                    if ($bonus->axpires_at < date('Y-m-d H:i:s'))
                                        return '<p class = "film_active">Активен</p>';
                                    else
                                        return '<p class = "film_disabled">Не активен</p>';
                                })()."
                            </div>
                    </div>
                ";
            }

            return response()->json(array('result' => $html), 200);
        }

        return response()->json(array('result' => ''), 200);
    }

    public function getUserInfo(Request $request)
    {
        $userInfo = User::where('id', Auth::user()->id)->get()[0];
        $html = "
            <div class = 'user_info_wrapper'>
            <div class = 'row'>
                <label for = 'name' class = ''>Имя:</label>
                <div class = 'input name'>
                    <input id = 'name' type = 'name' class = '' name = 'name' value = '".$userInfo->name."' required>
                </div>
            </div>
            <div class = 'row'>
                <label for = 'surname' class = ''>Фамилия:</label>
                <div class = 'input surname'>
                    <input id = 'surname' type='surname' class = '' name = 'surname' value = '".$userInfo->surname."' required>
                </div>
            </div>
            <div class = 'row'>
                <label for = 'email' class = ''>E-mail:</label>
                <div class = 'input email'>
                    <input id = 'email' type='text' class = '' name = 'email' value = '".$userInfo->email."' required>
                </div>
            </div>
            <div class = 'row'>
                <label for = 'old_password' class = ''>Старый пароль:</label>
                <div class = 'input old_password'>
                    <input id = 'old_password' type='password' class = '' name = 'old_password' required>
                </div>
            </div>
            <div class = 'row'>
                <label for = 'password' class = ''>Новый пароль:</label>
                <div class = 'input password'>
                    <input id = 'password' type='password' class = '' name = 'password' required>
                </div>
            </div>
            <div class = 'row'>
                <label for = 'confirm_password' class = ''>Подтвердите пароль:</label>
                <div class = 'input confirm_password'>
                    <input id = 'confirm_password' type='password' class = '' name = 'confirm_password' required>
                </div>
            </div>
            <div class = 'row'>
                <label for = 'phone' class = ''>Номер телефона:</label>
                <div class = 'input phone'>
                    <input id = 'phone' type='text' class = '' name = 'phone' value = '".$userInfo->phone."' required>
                </div>
            </div>
            <button id = 'change_credentials' type = 'submit'>
                Сохранить
            </button>
        </div>
        ";

        return response()->json(array('result' => $html), 200);
    }

    public function saveUserWanted(Request $request)
    {
        $filmId = Films::where('name', $request->filmName)->get()[0]->id;
        $doesUserHave = UserNotifications::where([
            'user_id' => Auth::user()->id,
            'film_id' => $filmId
        ])->get();
        
        if (!isset($doesUserHave[0])) {
            UserNotifications::insert([
                'user_id' => Auth::user()->id,
                'film_id' => $filmId
            ]);
        }
        
        return response()->json(array('result' => 1), 200);
    }

    public function checkUserPassword(Request $request)
    {
        $password = User::where('id', Auth::user()->id)->get()[0]->password;

        if (Hash::check($request->password, $password))
            $result = true;
        else
            $result = false;

        return response()->json(array('result' => $result), 200);
    }

    public function saveNewUserCredentials(Request $request)
    {
        User::where('id', Auth::user()->id)->update([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone
        ]);

        return response()->json(array('result' => 'Данные успешно изменены!'), 200);
    }
}
