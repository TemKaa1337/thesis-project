<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/slider.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/film_page_styles.css') }}" rel="stylesheet" type="text/css" >
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
                    <li><img src = "{{ asset('img/film_slider/maxresdefault.jpg') }}"></img></li>
                    <li style="background: #aaa;"><img src = "{{ asset('img/film_slider/example2.jpg') }}"></img></li>
                    <li>SLIDE 3</li>
                    <li style="background: #aaa;"><img src = "{{ asset('img/film_slider/example3.jpg') }}"></img></li>
                </ul>  
            </div>
            <div></div>

            <div></div>
            <div class = "film_page_content">
                <div class = "film_page_preview">
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                </div>
                <div class = "film_page_description">
                    <h1>Название фильма</h1>
                    <hr></hr>
                    <div>
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
                    <div>Vibrat kinoteatr i vremya</div>
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
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                </div>
            </div>
            <div></div>

            <div></div>
            <div class = "footer">
                TESTESTESTESTESTESTEST
            </div>
            <div></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src = "{{ URL::asset('js/script.js') }}"></script>
        <script src = "{{ URL::asset('js/slider.js') }}"></script>
    </body>
</html>
