<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api_token" content="{{ (Auth::user()) ? Auth::user()->api_token : '' }}">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/slider.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/cinema_page_styles.css') }}" rel="stylesheet" type="text/css" >
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
                    <img class = "film_image_name" src = "{{ asset($cinemaData->cinema_image) }}" style = "width: 270px;"></img>
                </div>
                <div class = "film_page_description">
                    <h1>Кинотеатр {{ $cinemaData->name }}</h1>
                    <h3>Описание кинотеатра</h3>
                    <p id = "p_description">{{ $cinemaData->description }}</p>
                </div>
                <div class = "film_page_characteristics">
                    <table>
                        <tbody>
                            <tr>
                                <td>Основан:</td>
                                <td>{{ $cinemaData->date_created->format('d.m.Y') }}</td>
                            </tr>
                            <tr>
                                <td>Терминал:</td>
                                <td>{{ $cinemaData->terminal }}</td>
                            </tr>
                            <tr>
                                <td>Бар:</td>
                                <td>{{ $cinemaData->bar }}</td>
                            </tr>
                            <tr>
                                <td>Паркинг:</td>
                                <td>{{ $cinemaData->parking }}</td>
                            </tr>
                            <tr>
                                <td>Метро:</td>
                                <td>{{ $cinemaData->metro }}</td>
                            </tr>
                            <tr>
                                <td>Телефон:</td>
                                <td>{{ $cinemaData->phones }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div></div>
            </div>
            <div></div>

            <div></div>
            <div class = "footer">
            </div>
            <div></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src = "{{ URL::asset('js/slider.js') }}"></script>
    </body>
</html>
