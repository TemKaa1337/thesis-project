<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
                        <li><a href = "mainpage">Main page</a></li>
                        <li><a href = "mainpage">Cinema ticket booking</a></li>
                        <li><a href = "mainpage">Contacts</a></li>
                        <li><a href = "mainpage">About us</a></li>
                        <li><a href = "mainpage">Sign up</a></li>
                        <li><a href = "mainpage">Sign in</a></li>
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
                    <h1>{{$filmDescription->name}}</h1>
                    <hr></hr>
                    <div class = "">
                        <table>
                            <tbody>
                                <tr>
                                    <td>ПН</td>
                                    <td>ВТ</td>
                                    <td>СР</td>
                                </tr>
                                <tr>
                                    <td data-date = "27.04.2020, среда" class = "enabled"><span class = "film_date" >27</span></td>
                                    <td data-date = "28.04.2020, четверг" class = "disabled"><span class = "film_date">28</span></td>
                                    <td data-date = "29.04.2020, пятница" class = "disabled"><span class = "film_date">29</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style = "height: 50px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Кинотеатр Беларусь:</td>
                                    <td><a data-cinema = "Беларусь" class = "session_time">17:10</a></td>
                                    <td><a data-cinema = "Беларусь" class = "session_time">19:10</a></td>
                                    <td><a data-cinema = "Беларусь" class = "session_time">21:10</a></td>
                                </tr>
                                <tr>
                                    <td>Кинотеатр Лохотрон:</td>
                                    <td><a data-cinema = "Лохотрон" class = "session_time">17:10</a></td>
                                    <td><a data-cinema = "Лохотрон" class = "session_time">19:10</a></td>
                                    <td><a data-cinema = "Лохотрон" class = "session_time">21:10</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <hr></hr>
                </div>
                <div class = "film_page_characteristics">
                    <table>
                        <tbody>
                            <tr>
                                <td>Дата показа:</td>
                                <td>С {{$filmDescription->date_shown_from->format('d.m.Y')}} по {{$filmDescription->date_shown_to->format('d.m.Y')}}</td>
                            </tr>
                            <tr>
                                <td>Страна:</td>
                                <td>{{$filmDescription->country}}, {{$filmDescription->year}}</td>
                            </tr>
                            <tr>
                                <td>Длительность:</td>
                                <td>{{$filmDescription->duration}}</td>
                            </tr>
                            <tr>
                                <td>Жанр:</td>
                                <td>{{$filmDescription->genre}}</td>
                            </tr>
                            <tr>
                                <td>Режиссер:</td>
                                <td>{{$filmDescription->producer}}</td>
                            </tr>
                            <tr>
                                <td>Актерский состав:</td>
                                <td>{{$filmDescription->actors}}</td>
                            </tr>
                            <tr>
                                <td>Возрастное ограничение:</td>
                                <td>{{$filmDescription->age_restriction}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class = "film_page_other">
                    <h3>Описание фильма</h3>
                    <p id = "p_description">{{$filmDescription->description}}</p>
                    <iframe width="560" height="315" src="{{$filmDescription->trailer}}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    <div class = "leave_comment">
                        <form action="#" method="post">
                            <textarea placeholder = "Оставьте отзыв."></textarea>
                            <button type="submit">Отправить</button>
                        </form>
                    </div>
                    <div class = "comment_wrapper">
                        <hr></hr>
                        <div class="comment_container">
                            <img src = "{{ asset('img/avatars/avatar.png') }}" alt="Avatar" style="width:90px">
                            <p><span >Артем Сергеевич</span>28.09.2020 в 9:12</p>
                            <p>Фильм говно</p>
                        </div>

                        <hr></hr>
                        <div class="comment_container">
                            <img src = "{{ asset('img/avatars/avatar.png') }}" alt="Avatar" style="width:90px">
                            <p><span >Артем Сергеевич</span>28.09.2020 в 9:12</p>
                            <p>Фильм говно</p>
                        </div>
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
    </body>
</html>
