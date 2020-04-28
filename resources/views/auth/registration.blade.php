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
                <div class = "row">
                    <label for = "username" class = "">Имя пользователя:</label>
                    <div class = "input username">
                        <input id = "username" type="text" class = "" name = "username" required autocomplete = "username">
                    </div>
               </div>
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
                    <label for = "lastname" class = "">Отчество:</label>
                    <div class = "input lastname">
                        <input id = "lastname" type="text" class="" name = "lastname" autocomplete = "lastname">
                    </div>
               </div>
               <div class = "row">
                    <label for = "gender" class = "">Пол:</label>
                    <div class = "input gender">
                        <input id = "gender" type="radio" value = "Мужчина" class = "" name = "gender" required autocomplete = "gender">
                        <input id = "gender" type="radio" value = "Женщина" class = "" name = "gender" required autocomplete = "gender">
                    </div>
               </div>
               <div class = "row">
                    <label for = "birth_date" class = "">Дата рождения:</label>
                    <div class = "input birth_date">
                        <input id = "birth_date" type="radio" class = "" name = "birth_date" required>
                    </div>
               </div>
           </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </body>
</html>
