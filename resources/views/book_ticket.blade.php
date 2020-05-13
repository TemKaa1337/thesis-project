<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api_token" content="{{ (Auth::user()) ? Auth::user()->api_token : '' }}">
        <meta name="filmId" content="{{ $filmId }}">
        <meta name="sessionTime" content="{{ $sessionTime }}">
        <meta name="cinema" content="{{ $cinema }}">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/slider.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/book.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/submit_booking.css') }}" rel="stylesheet" type="text/css" >
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
            <div class = "ticket_book">
                <h1>Экран</h1>
                <div class = "screen"></div>
                @foreach ($places as $rowNumber => $rowPlaces)
                    <div class = "row">
                        <a class = "line_left">{{ $loop->iteration }}</a>
                        @foreach ($rowPlaces as $placeNumber => $isBusy)
                            @if ($isBusy == 1)
                                <a class = "film_place busy" data-row = "{{ $rowNumber }}" data-place = "{{ $placeNumber }}"><span>{{ $placeNumber }}</span></a>
                            @else
                                <a class = "film_place free" data-row = "{{ $rowNumber }}" data-place = "{{ $placeNumber }}"><span>{{ $placeNumber }}</span></a>
                            @endif
                        @endforeach
                        <a class = "line_right">{{ $loop->iteration }}</a>
                    </div>
                @endforeach
                <a id = "book_button" class = "book_button">Забронировать</a>
            </div>
            <div></div>

            <div></div>
            <div class = "footer">
            </div>
            <div></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src = "{{ URL::asset('js/bookTicket.js') }}"></script>
        <script src = "{{ URL::asset('js/slider.js') }}"></script>
    </body>
</html>
