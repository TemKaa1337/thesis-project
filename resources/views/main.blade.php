<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/slider.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/button.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/reset_button.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/dropdown.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class = "wrapper">
            <div></div>
            <div class = "header">
                <nav>
                    <ul>
                        <li><a href = "{{ url('/') }}">Главная</a></li>
                        <li><a href = "mainpage">Cinema ticket booking</a></li>
                        <li><a href = "mainpage">Contacts</a></li>
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

            <div id="slider">
                <a href="#" class="control_next">></a>
                <a href="#" class="control_prev"><</a>
                <ul>
                    @foreach ($sliders as $slider)
                        <li><img src = "{{ asset($slider->slider_image) }}"></img></li>
                    @endforeach
                </ul>  
            </div>

            <div></div>

            <div></div>
            <div class = "filter">
                <label for = "filter" class = "film_filter">Выберите фильтр для фильмов:</label>
                <span class = "dropdown">
                    <select id = "filter" class = "film_filter_select">
                        <option disabled selected value>Выберите параметр</option>
                        <option value = "genre">Жанр</option>
                        <option value = "date_shown">Дата показа</option>
                        <option value = "cinema">Кинотеатр</option>
                    </select>
                </span>

                <label for = "filter_value" class = "film_filter_value detailed">Выберите значение:</label>
                <span class = "dropdown detailed">
                    <select id = "filter_value" class = "film_filter_select_value">
                    </select>
                </span>
                <a id = "reset_button" class = "reset_button detailed">Сбросить фильтр</a>
            </div>
            <div></div>

            <div></div>
            <div class = "content">
                @foreach ($films as $film)
                    <div class = "event">
                        <p class = "film_name">{{$film->name}}</p>
                        <img class = "film_image_name" src = "{{ asset($film->preview_image) }}"></img>
                        <div class = "short_film_description">
                            <p class = "">Жанр: {{$film->genre}}</p>
                            <a class = "button" href = "{{ url('/movie/'.$film->id) }}" >Смотреть описание</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div></div>
            <div></div>
            <div class = "footer">
                
            </div>
            <div></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src = "{{ URL::asset('js/main.js') }}"></script>
        <script src = "{{ URL::asset('js/slider.js') }}"></script>
    </body>
</html>
