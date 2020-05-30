<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Новый сеанс!</title>
    </head>
    <body>
        <h1>Новый сеанс на фильм {{ $data['filmName'] }}</h1>
        <p>Дорогой подписчик! В кино добавили новый сеанс в кинотеатре {{ $data['filmName'] }} в {{ $data['sessinTime'] }} на фильм {{ $data['filmName'] }}</p>
    </body>
</html>
