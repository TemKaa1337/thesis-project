<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/slider.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/button.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/dropdown.css') }}" rel="stylesheet" type="text/css" >
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

            <div id="slider">
                <a href="#" class="control_next">></a>
                <a href="#" class="control_prev"><</a>
                <ul>
                    <li><img src = "{{ asset('img/film_slider/maxresdefault.jpg') }}"></img></li>
                    <li style="background: #aaa;"><img src = "{{ asset('img/film_slider/example2.jpg') }}"></img></li>
                    <li>SLIDE 3</li>
                    <li style="background: #aaa;"><img src = "{{ asset('img/film_slider/example3.jpg') }}"></img></li>
                    <!-- <li>SLIDE 1</li>
                    <li>SLIDE 2</li>
                    <li>SLIDE 3</li>
                    <li>SLIDE 4</li> -->
                </ul>  
            </div>

            <div></div>

            <div></div>
            <div class = "filter">
                <label for="filter" class = "film_filter">Выберите фильтр для фильмов:</label>
                <span class = "dropdown">
                    <select id="filter" class = "film_filter_select">
                        <option value="genre">Жанр</option>
                        <option value="date_shown">Дата показа</option>
                        <option value="cinema">Кинотеатр</option>
                    </select>
                </span>

                <label for="filter_value" class = "film_filter_value">Выберите значение:</label>
                <span class = "dropdown">
                    <select id="filter_value" class = "film_filter_select_value">
                        <option value="genre">Жанр</option>
                        <option value="date_shown">Дата показа</option>
                        <option value="cinema">Кинотеатр</option>
                    </select>
                </span>
            </div>
            <div></div>

            <div></div>
            <div class = "content">
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
                </div>
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
                </div>
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
                </div>
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
                </div>
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
                </div>
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
                </div>
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
                </div>
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
                </div>
                <div class = "event">
                    <p class = "film_name">Я все еще верю</p>
                    <img class = "film_image_name" src = "{{ asset('img/film_previews/i_still_believe.jpg') }}"></img>
                    <div class = "short_film_description">
                        <p class = "">Жанр: триллер</p>
                        <a class = "button" href = '#' >Смотреть описание</a>
                    </div>
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
