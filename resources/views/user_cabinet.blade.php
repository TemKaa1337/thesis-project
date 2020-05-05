<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api_token" content="{{ (Auth::user()) ? Auth::user()->api_token : '' }}">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/user_cabinet.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/unbook.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class = "wrapper">
            <div></div>
            <div class = "header">
                <nav class = "nav_header">
                    <ul>
                        <li><a href = "{{ url('/') }}">Главная</a></li>
                        <li><a href = "mainpage">Cinema ticket booking</a></li>
                        <li><a href = "mainpage">Contacts</a></li>
                        <li><a href = "mainpage">О нас</a></li>
                        @if (Auth::guest())
                            <li><a href = "{{ route('register') }}">Регистрация</a></li>
                            <li><a href = "{{ route('login') }}">Вход</a></li>
                        @else
                            <li><a href = "{{ url('/cabinet') }}">Личный кабинет</a></li>
                            <li><a href = "{{ route('logout') }}">Выход</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
            <div></div>
            
            <div></div>
            <div class = "user_content">
                <nav class = "navigation">
                    <ul id = "navigation">
                        <li class = "selected">Мои билеты</li>
                        <li>Мои комментарии</li>
                        <li>Мои бонусы</li>
                        <li>Информация обо мне</li>
                    </ul>
                </nav>
                <div class = "navigation_content">
                    @foreach ($bookedPlaces as $sessions)
                        <div class = "ticket_item">
                            @foreach ($sessions as $filmName => $filmInfo)
                                <div>
                                    <p>{{ $filmName }}</p>
                                </div>
                                <div>
                                    <p>{{ $filmInfo['datetime_shown'] }}</p>
                                </div>
                                <div>
                                    <p>Мест: {{ $filmInfo['placesCount'] }}</p>
                                </div>
                                <div>
                                    @if ($filmInfo['status'])
                                        <p class = 'film_active'>Активен</p>
                                    @else
                                        <p class = 'film_disabled'>Не активен</p>
                                    @endif
                                </div>
                                @foreach ($filmInfo['places'] as $places)
                                    <div>
                                        <p>Кинотеатр: {{ $filmInfo['cinema'] }}</p>
                                    </div>
                                    <div>
                                        <p>Ряд: {{ $places['row'] }}</p>
                                    </div>
                                    <div>
                                        <p>Место: {{ $places['place'] }}</p>
                                    </div>
                                    <div style = "text-align: center;">
                                        <a id = "book_button" class = "book_button" data-date = "{{ $filmInfo['datetime_shown'] }}" data-place = "{{ $places['place'] }}" data-row = "{{ $places['row'] }}" data-cinema = "{{ $filmInfo['filmId'] }}">Снять бронь</a>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    @endforeach
                    <!-- <div class = "ticket_item">
                        <div>
                            <p>Интерстеллар</p>
                        </div>
                        <div>
                            <p>21.05.2020 19:45</p>
                        </div>
                        <div>
                            <p>Мест: 2</p>
                        </div>
                        <div>
                            <p class = 'film_active'>Активен</p>
                        </div>
                        <div>
                            <p>Кинотеатр: Беларусь</p>
                        </div>
                        <div>
                            <p>Ряд: 10</p>
                        </div>
                        <div>
                            <p>Место: 10</p>
                        </div>
                        <div style = "text-align: center;"><a id = "book_button" class = "book_button">Снять бронь</a></div>
                    </div> -->
                </div>
            </div>
            <div></div>
            <div></div>
            <div class = "footer">
                
            </div>
            <div></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>
</html>
