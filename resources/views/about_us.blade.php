<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/slider.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/about_us.css') }}" rel="stylesheet" type="text/css" >
    </head>
    <body>
        <div class = "wrapper">
            <div></div>
            <div class = "header">
                <nav>
                    <ul>
                        <li><a href = "{{ url('/') }}">Главная</a></li>
                        <li><a href = "{{ url('/about_us') }}">О нас</a></li>
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
            <div id="slider">
                <a href="#" class="control_next">></a>
                <a href="#" class="control_prev"><</a>
                <ul>
                    @foreach ($sliders as $slider)
                        <li><img src = "{{ asset($slider->slider_image) }}"></img></li>
                    @endforeach
                </ul>  
            </div>
            <div></div>

            <div></div>
            <div class = "content_about">
                <p>Доброго времени суток, уважаемый посититель! Этот проект является дипломной работой на факульете компьютерных систем и сетей, специальности "программное обеспечение информационных технологий". Автор этого проекта - Артем Комаров. Это его ссылки на социальные сети.</p>
                <ul>
                    <li><a href = "https://github.com/TemKaa1337">Github Account</a></li>
                    <li><a href = "https://vk.com/komaarov">Vkontakte</a></li>
                    <li><a href = "https://www.linkedin.com/in/artem-komarov-904896192/">Linked in</a></li>
                </ul>
            </div>
            <div></div>

            <div></div>
            <div class = "footer">
                
            </div>
            <div></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src = "{{ URL::asset('js/main.js') }}"></script>
        <script src = "{{ URL::asset('js/slider.js') }}"></script>
    </body>
</html>
