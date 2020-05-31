<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api_token" content="{{ (Auth::user()) ? Auth::user()->api_token : '' }}">
        <meta name="film_name" content="{{ $filmDescription->name }}">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/slider.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/film_page_styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/submit_comment.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class = "wrapper">
            <div></div>
            <div class = "header">
                <nav>
                    <ul>
                    <li><a href = "{{ url('/') }}">Главная</a></li>
                        <li><a href = "mainpage">Контакты</a></li>
                        <li><a href = "mainpage">О нас</a></li>
                        @if (Auth::guest())
                            <li><a href = "{{ route('register') }}">Регистрация</a></li>
                            <li><a href = "{{ route('login') }}">Вход</a></li>
                        @else
                            @if (Auth::user()->hasAnyRole('admin'))
                                <li><a href = "{{ url('/admin/dashboard') }}">Панель администратора</a></li>
                            @endif
                            <li><a href = "{{ url('/cabinet') }}">Личный кабинет</a></li>
                            <li><a href = "{{ route('logout') }}">Выход</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div></div>

            <div></div>
            <div id = "slider">
                <a href = "#" class = "control_next">></a>
                <a href = "#" class = "control_prev"><</a>
                <ul>
                    @foreach ($sliders as $slider)
                        <li><img src = "{{ asset($slider->slider_image) }}"></img></li>
                    @endforeach
                </ul>  
            </div>
            <div></div>

            <div></div>
            <div class = "film_page_content">
                <div class = "film_page_preview">
                    <img class = "film_image_name" src = "{{ asset($filmDescription->film_page_image) }}" style = "width: 270px;"></img>
                </div>
                <div class = "film_page_description">
                    @if ($sessionTimes !== [])
                        <h1 id = "film_name">{{ $filmDescription->name }}</h1>
                    @else
                        <h1 id = "film_name" data-cinema = "{{ $filmDescription->name }}" >{{ $filmDescription->name }}   @if (Auth::user() && !Auth::user()->hasAnyRoles(['admin', 'manager']))<button type = "submit" data-cinema = "{{ $filmDescription->name }}" class = "want_to_see">Хочу посмотреть</button> @endif</h1>
                    @endif
                    @if ($sessionTimes !== [])
                        <hr></hr>
                        <div class = "">
                            <table>
                                <tbody>
                                    <tr>
                                        @foreach ($sessionDayNames as $dayName)
                                            <td class = "text">{{ $dayName }}</td>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($sessionDayValues as $dayValue)
                                            @if ($loop->first)
                                                <td data-date = "{{ $dayValue->format('Y-m-d') }}" data-film = "{{ $filmId }}" class = "enabled border"><span class = "film_date" >{{ $dayValue->format('d') }}</span></td>
                                            @else
                                                <td data-date = "{{ $dayValue->format('Y-m-d') }}" data-film = "{{ $filmId }}" class = "disabled border"><span class = "film_date" >{{ $dayValue->format('d') }}</span></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div style = "height: 50px;">
                            <table id = "sessions_table">
                                <tbody>
                                    @foreach ($sessionTimes as $cinema => $sessions)
                                        <tr>
                                            <td><a href = "{{ url($sessions['cinemaId']) }}" >Кинотеатр {{ $cinema }}:</a></td>
                                            @foreach ($sessions['sessions'] as $session)
                                                <td>
                                                    <form action = "{{ url('book/film') }}" method = "POST">
                                                        @csrf
                                                        <input type = "hidden" name = "filmId" value = "{{ $filmId }}">
                                                        <input type = "hidden" name = "sessionTime" value = "{{ $session->format('Y-m-d H:i:s') }}">
                                                        <input type = "hidden" name = "cinema" value = "{{ $cinema }}">
                                                        <button type = "submit" data-cinema = "{{ $cinema }}" class = "session_time">{{ $session->format('H:i') }}</button>
                                                    </form>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <hr></hr>
                    @endif
                </div>
                <div class = "film_page_characteristics">
                    <table>
                        <tbody>
                            <tr>
                                <td>Дата показа:</td>
                                <td id = "datetime_shown_edit">С {{$filmDescription->date_shown_from->format('d.m.Y')}} по {{$filmDescription->date_shown_to->format('d.m.Y')}}</td>
                            </tr>
                            <tr>
                                <td>Страна:</td>
                                <td id = "country_edit">{{$filmDescription->country}}, {{$filmDescription->year}}</td>
                            </tr>
                            <tr>
                                <td>Длительность:</td>
                                <td id = "duration_edit">{{$filmDescription->duration}}</td>
                            </tr>
                            <tr>
                                <td>Жанр:</td>
                                <td id = "genre_edit">{{$filmDescription->genre}}</td>
                            </tr>
                            <tr>
                                <td>Режиссер:</td>
                                <td id = "producer_edit">{{$filmDescription->producer}}</td>
                            </tr>
                            <tr>
                                <td>Актерский состав:</td>
                                <td id = "actors_edit">{{$filmDescription->actors}}</td>
                            </tr>
                            <tr>
                                <td>Возрастное ограничение:</td>
                                <td id = "age_restrictions_edit">{{$filmDescription->age_restriction}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class = "film_page_other">
                    <h3>Описание фильма</h3>
                    <p id = "p_description">{{$filmDescription->description}}</p>
                    <iframe width="560" height="315" src="{{ $filmDescription->trailer }}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @if (Auth::user()->hasAnyRoles(['admin', 'manager']))
                        <button id = "edit_film" style = "margin-top: 5px; width: 150px;" class = "submit_comment" type="submit">Редактировать</button>
                    @endif
                    @if (Auth::user())
                        @if (!Auth::user()->is_banned)
                            <div class = "leave_comment">
                                <form id = "comment_submit" method="post" onsubmit = "e.preventDefault()">
                                    <textarea placeholder = "Оставьте отзыв." data-film = "{{ $filmId }}"></textarea>
                                    <button class = "submit_comment" type="submit">Отправить</button>
                                </form>
                            </div>
                        @endif
                    @endif
                    <div class = "comment_wrapper">
                        @foreach ($comments as $comment)
                            <hr></hr>
                            <div class="comment_container">
                                <img src = "{{ asset($comment->avatar) }}" alt="Avatar" style="width:90px">
                                <p>
                                    <span>
                                        {{ $comment->author }}
                                    </span>
                                    {{ $comment->insert_datetime->format('d.m.Y') }} в {{ $comment->insert_datetime->format('H:i') }}
                                    @if (Auth::user())
                                        @if (Auth::user()->hasAnyRoles(['admin', 'manager']))
                                            <a data-comment = "{{ $comment->id }}" data-film = "{{ $filmId }}" id = "button_delete" class = "button_delete">Delete</a>
                                            <a data-user = "{{ $comment->user_id }}" data-film = "{{ $filmId }}"  id = "button_ban" class = "button_ban">Ban</a>
                                        @endif
                                    @endif
                                </p>
                                
                                <p>{{ $comment->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div></div>

            <div></div>
            <div class = "footer">
            </div>
            <div></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src = "{{ URL::asset('js/slider.js') }}"></script>
        <script src = "{{ URL::asset('js/booking.js') }}"></script>
        <script src = "{{ URL::asset('js/edit_film.js') }}"></script>
    </body>
</html>
