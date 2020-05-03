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
                    {{ csrf_field() }}
                    <div class = "row">
                        <label for = "name" class = "">Имя:</label>
                        <div class = "input name">
                            <input id = "name" type="text" class="" name = "name" required autocomplete = "name">
                        </div>
                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class = "row">
                        <label for = "surname" class = "">Фамилия:</label>
                        <div class = "input surname">
                            <input id = "surname" type="text" class="" name = "surname" required autocomplete = "surname">
                        </div>
                        @if ($errors->has('surname'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('surname') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class = "row">
                        <label for = "email" class = "">E-mail:</label>
                        <div class = "input email">
                            <input id = "email" type="text" class = "" name = "email" required>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class = "row">
                        <label for = "password" class = "">Пароль:</label>
                        <div class = "input password">
                            <input id = "password" type="password" class = "" name = "password" required>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class = "row">
                        <label for = "password-confirm" class = "">Повторите пароль:</label>
                        <div class = "input password-confirm">
                            <input id = "password-confirm" type="password" class = "" name = "password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class = "row">
                        <label for = "phone" class = "">Ваш номер телефона:</label>
                        <div class = "input phone">
                            <input id = "phone" type="phone" class = "" name = "phone" required>
                        </div>
                        @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </div>
                    <button type="submit">
                        Зарегистрироваться
                    </button>
                </form>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>
</html>
