<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="api_token" content="{{ (Auth::user()) ? Auth::user()->api_token : '' }}">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/admin_dashboard.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/dropdown.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/reset_button.css') }}" rel="stylesheet" type="text/css" >
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
            <div class = "user_content">
                <nav class = "navigation">
                    <ul id = "navigation">
                        <li class = "selected" id = "add_film">Добавить новый фильм</li>
                        <li id = "add_session">Добавить сеансы</li>
                        <li id = "remove_session">Удалить сеансы</li>
                    </ul>
                </nav>
                <div id = "navigation_content" class = "navigation_content">
                    <div class = "content_item add_film">
                        <div class = "upload_film_image_preview" >
                            <p>Выберите изображение для превью фильма</p>
                            <input type = "file" id = "upload_film_image_preview_input">
                        </div>
                        <!-- <div class = "new_film_image_preview">

                        </div> -->
                    </div>
                    <div class = "content_item add_film">
                        <div class = "upload_film_image" >
                            <p>Выберите изображение для страницы фильма</p>
                            <input type = "file" id = "upload_film_image_input">
                        </div>
                        <!-- <div class = "new_film_image">

                        </div> -->
                    </div>
                    <div class = "content_item add_film">
                        <table>
                            <tbody>
                                <tr>
                                    <td>Дата показа:</td>
                                    <td>С 
                                        <input id = "date_shown_from" type = "date" class = "" name = "date_shown_from" required><br>
                                        по
                                        <input id = "date_shown_to" type = "date" class = "" name = "date_shown_to" required> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Страна:</td>
                                    <td>
                                        <input id = "country" type = "text" class = "" name = "country" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Год:</td>
                                    <td>
                                        <input id = "year" type = "text" class = "" name = "year" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Длительность:</td>
                                    <td>
                                        <input id = "length" type = "text" class = "" name = "length" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Жанр:</td>
                                    <td>
                                        <input id = "genre" type = "text" class = "" name = "genre" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Режиссер:</td>
                                    <td>
                                        <input id = "producer" type = "text" class = "" name = "producer" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Актерский состав:</td>
                                    <td>
                                        <textarea rows = "" cols = "" id = "actors" type = "text" class = "" name = "actors" required>
                                        </textarea>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Возрастное ограничение:</td>
                                    <td>
                                        <input id = "age_restrictions" type = "text" class = "" name = "age_restrictions" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Сылка на трейлер:</td>
                                    <td>
                                        <input id = "trailer" type = "text" class = "" name = "trailer" required>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class = "content_item new_film_name add_film">
                        <label style = "" for = "film_name" class = "">Название фильма:</label>
                        <div style = "" class = "input new_film_name_input">
                            <input id = "film_name" value = "" type = "text" class = "" name = "film_name_text" required/>
                        </div>
                        <label style = "" for = "film_description" class = "">Описание фильма:</label>
                        <div style = "" class = "input new_film_description">
                            <textarea rows = "10" cols = "50" id = "film_description" type = "text" class = "" name = "film_description" required></textarea>
                        </div>
                        <a id = "button" class = "button" href = "" >Добавить фильм</a>
                    </div>
                </div>
            </div>
            <div></div>
            <div></div>
            <div class = "footer">
                
            </div>
            <div></div>
        </div>

        <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src = "{{ URL::asset('js/admin.js') }}"></script>
        <script src = "{{ URL::asset('js/admin_html.js') }}"></script>
    </body>
</html>
