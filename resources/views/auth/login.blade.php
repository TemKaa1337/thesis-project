<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cinema ticket booking</title>
    
        <link href = "{{ URL::asset('css/auth/login.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class = "wrapper">
            <div id = 'register_form'>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
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
                    <button type = "submit">
                        Войти
                    </button>
                </form>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>
</html>
