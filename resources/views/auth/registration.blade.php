<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cinema ticket booking</title>

        <!-- <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" > -->
        <link href = "{{ URL::asset('css/auth/register.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class = "wrapper">
            <div id = 'register_form'>
                <form method="POST" action="{{ route('register') }}">
                    <div class = "row">
                        <label for = "name" class = "">Имя:</label>
                        <div class = "input name">
                            <input id = "name" type="text" class="" name = "name" required autocomplete = "name">
                        </div>
                    </div>
                    <div class = "row">
                        <label for = "surname" class = "">Фамилия:</label>
                        <div class = "input surname">
                            <input id = "surname" type="text" class="" name = "surname" required autocomplete = "surname">
                        </div>
                    </div>
                    <div class = "row">
                        <label for = "email" class = "">E-mail:</label>
                        <div class = "input email">
                            <input id = "email" type="text" class = "" name = "email" required>
                        </div>
                    </div>
                    <div class = "row">
                        <label for = "password" class = "">Пароль:</label>
                        <div class = "input password">
                            <input id = "password" type="password" class = "" name = "password" required>
                        </div>
                    </div>
                    <div class = "row">
                        <label for = "phone" class = "">Ваш номер телефона:</label>
                        <div class = "input phone">
                            <input id = "phone" type="phone" class = "" name = "phone" required>
                        </div>
                    </div>
                    <button type="submit">
                        {{ __('Register') }}
                    </button>
                </form>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>
</html>
