<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Films;
use App\Comments;
use App\User;
use Illuminate\Support\Facades\Storage;
use Auth;

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

    public function makeAction(Request $request)
    {
        if ($request->option == 'delete') {
            Comments::where('id', $request->commentId)->delete();
            $allComments = Comments::where('film_id', $request->filmId)->get();
        } else if ($request->option == 'ban') {
            User::where('id', $request->userId)->update(['is_banned' => true]);
            Comments::where('user_id', $request->userId)->delete();
            $allComments = Comments::where('film_id', $request->filmId)->get();
        }

        return $this->generateCommentsHtml($allComments, $request);
    }

    public function generateCommentsHtml($allComments, $request)
    {
        $html = '';

        foreach ($allComments as $comment) {
            $html .= "
                <hr></hr>
                <div class='comment_container'>
                    <img src = '".asset($comment->avatar)."' alt='Avatar' style='width:90px'>
                    <p>
                        <span>
                            ".$comment->author."
                        </span>
                        ".$comment->insert_datetime->format('d.m.Y')." в ".$comment->insert_datetime->format('H:i')."
                        ".$this->getButtonsHtml($comment, $request->filmId)."
                    </p>
                    
                    <p>". $comment->comment ."</p>
                </div>
            ";
        }

        return response()->json(array('result' => $html), 200);
    }

    public function getButtonsHtml($comment, $filmId)
    {
        if (Auth::user()) {
            if (Auth::user()->hasAnyRoles(['admin', 'manager'])) {
                return "
                    <a data-comment = '".$comment->id ."' data-film = '".$filmId."' id = 'button_delete' class = 'button_delete'>Delete</a>
                    <a data-user = '".$comment->user_id."' data-film = '".$filmId."' id = 'button_ban' class = 'button_ban'>Ban</a>
                ";
            }
        }

        return '';
    }

    public function getUsersList(Request $request)
    {
        $html = '';
        $users = User::all();
        
        foreach ($users as $user) {
            $html .= "
                <div class = 'user_list'>
                    <div>
                        <span class = 'dropdown'>
                            <p class = 'dropdown_user'>".$user->name."</p>
                        </span>
                    </div>
                    <div>
                        <span class = 'dropdown'>
                            <pclass = 'dropdown_user'>".$user->email."</p>
                        </span>
                    </div>".(function () use ($user) {
                        if ($user->is_banned == false)
                            return "
                                <div>
                                    <a data-user = ".$user->id." class = 'ban_button'>Заблокировать пользователя</a>
                                </div>";
                        else
                            return '';
                    })()."
                    <div>
                        <a data-user = ".$user->id." class = 'remove_button'>Удалить пользователя</a>
                    </div>
                </div>";
        }
        

        return response()->json(array('result' => $html), 200);
    }

    public function banUser(Request $request)
    {
        User::where('id', $request->id)->update([
            'is_banned' => true
        ]);
        return $this->getUsersList($request);
    }

    public function deleteUser(Request $request)
    {
        User::where('id', $request->id)->delete();
        return $this->getUsersList($request);
    }
}
