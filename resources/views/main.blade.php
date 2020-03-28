<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cinema ticket booking</title>

        <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >

        <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <div class = "container">
                <a class = "header-logo"><img class = "header-logo-image" src = "{{ URL::asset('img/popcorn_transparent.png') }}" ></a>
                <nav>
                    <ul>
                        <li><a href = "mainpage">Main page</a></li>
                        <li><a href = "mainpage">Cinema ticket booking</a></li>
                        <li><a href = "mainpage">Contacts</a></li>
                        <li><a href = "mainpage">About us</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class = "main">
            <div class = "container">

            </div>
        </div>
        <footer>
            <div class = "container">

            </div>
        </footer>
    </body>
</html>
