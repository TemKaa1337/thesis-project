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
        <!-- <link href = "{{ URL::asset('css/button.css') }}" rel="stylesheet" type="text/css" > -->
        <!-- <link href = "{{ URL::asset('css/dropdown.css') }}" rel="stylesheet" type="text/css" > -->
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
                    <li><img src = "{{ asset('img/film_slider/nice_1.jpg') }}"></img></li>
                    <li><img src = "{{ asset('img/film_slider/nice_2.jpg') }}"></img></li>
                </ul>  
            </div>
            <div></div>

            <div></div>
            <div class = "film_page_content">
                <div class = "film_page_preview">
                    <img class = "film_image_name" src = "{{ asset('img/film_page/example.jpg') }}" style = "width: 270px;"></img>
                </div>
                <div class = "film_page_description">
                    <h1>Я все еще верю</h1>
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
                                    <td><span class = "film_date">27</span></td>
                                    <td><span class = "film_date">28</span></td>
                                    <td><span class = "film_date">29</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style = "height: 50px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Кинотеатр Беларусь:</td>
                                    <td><a class = "session_time">17:10</a></td>
                                    <td><a class = "session_time">19:10</a></td>
                                    <td><a class = "session_time">21:10</a></td>
                                </tr>
                                <tr>
                                    <td>Кинотеатр Лохотрон:</td>
                                    <td><a class = "session_time">17:10</a></td>
                                    <td><a class = "session_time">19:10</a></td>
                                    <td><a class = "session_time">21:10</a></td>
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
                                <td>с 23 апреля по 29 апреля</td>
                            </tr>
                            <tr>
                                <td>Страна:</td>
                                <td>Россия, 2020</td>
                            </tr>
                            <tr>
                                <td>Длительность:</td>
                                <td>115 мин</td>
                            </tr>
                            <tr>
                                <td>Жанр:</td>
                                <td>Мелодрама, Комедия</td>
                            </tr>
                            <tr>
                                <td>Режиссер:</td>
                                <td>Константин Статский</td>
                            </tr>
                            <tr>
                                <td>Актерский состав:</td>
                                <td>Милош Бикович, Диана Пожарская, Борис Дергачев, Александра Кузенкина, Любомир Бандович, Барбара Таталович, Миодраг Радонич, Елизавета Орашанин</td>
                            </tr>
                            <tr>
                                <td>Возрастное ограничение:</td>
                                <td>16+</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class = "film_page_other">
                    <h3>Описание фильма</h3>
                    <p id = "p_description">Паша, сербский сердцеед и весельчак, — хозяин пятизвездочного отеля в Белграде. Он живет, не зная бед, пока однажды совершенно случайно не портит новое — многомиллионное! — приобретение коллекционера-мафиози. В уплату долга криминальный босс заставляет Пашу жениться на своей дочке. Девушка начинает рьяно готовиться к свадьбе с красавчиком отельером, когда Паша после четырехлетней разлуки неожиданно сталкивается с Дашей, своей русской любовью. В романтичной атмосфере древнего города чувства между ними готовы вспыхнуть вновь…если бы не будущий тесть, настоящий муж, слепой дед и друг-банкрот!..</p>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/1ZV0WoipyC4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
        <script src = "{{ URL::asset('js/script.js') }}"></script>
        <script src = "{{ URL::asset('js/slider.js') }}"></script>
    </body>
</html>
