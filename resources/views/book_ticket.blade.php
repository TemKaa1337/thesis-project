<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Cinema ticket booking</title>

        <link href = "{{ URL::asset('css/styles.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/slider.css') }}" rel="stylesheet" type="text/css" >
        <link href = "{{ URL::asset('css/book.css') }}" rel="stylesheet" type="text/css" >
        <!-- <link href = "{{ URL::asset('css/film_page_styles.css') }}" rel="stylesheet" type="text/css" > -->
        <!-- <link href = "{{ URL::asset('css/submit_comment.css') }}" rel="stylesheet" type="text/css" > -->
        <!-- <link href = "{{ URL::asset('css/button.css') }}" rel="stylesheet" type="text/css" > -->
        <!-- <link href = "{{ URL::asset('css/dropdown.css') }}" rel="stylesheet" type="text/css" > -->
    </head>
    <body>
        <div class = "wrapper">
            <div></div>
            <div class = "header">
                <nav>
                    <ul>
                        <li><a href = "mainpage">Main page</a></li>
                        <li><a href = "mainpage">Cinema ticket booking</a></li>
                        <li><a href = "mainpage">Contacts</a></li>
                        <li><a href = "mainpage">About us</a></li>
                        <li><a href = "mainpage">Sign up</a></li>
                        <li><a href = "mainpage">Sign in</a></li>
                    </ul>
                </nav>
            </div>
            <div></div>

            <div></div>
            <div id = "slider">
                <a href = "#" class = "control_next">></a>
                <a href = "#" class = "control_prev"><</a>
                <ul>
                    <li><img src = "{{ asset('img/film_slider/nice_1.jpg') }}"></img></li>
                    <li><img src = "{{ asset('img/film_slider/nice_2.jpg') }}"></img></li>
                </ul>  
            </div>
            <div></div>

            <div></div>
            <div class = "ticket_book">
                <h1>Экран</h1>
                <div class = "screen"></div>
                <div class = "row">
                    <a class = "line_left">1</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">1</a>
                </div>
                <div class = "row">
                    <a class = "line_left">2</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">2</a>
                </div>
                <div class = "row">
                    <a class = "line_left">3</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">3</a>
                </div>
                <div class = "row">
                    <a class = "line_left">4</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">4</a>
                </div>
                <div class = "row">
                    <a class = "line_left">5</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">5</a>
                </div>
                <div class = "row">
                    <a class = "line_left">6</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">6</a>
                </div>
                <div class = "row">
                    <a class = "line_left">7</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">7</a>
                </div>
                <div class = "row">
                    <a class = "line_left">8</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">8</a>
                </div>
                <div class = "row">
                    <a class = "line_left">9</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">9</a>
                </div>
                <div class = "row">
                    <a class = "line_left">10</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">10</a>
                </div>
                <div class = "row">
                    <a class = "line_left">11</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">11</a>
                </div>
                <div class = "row">
                    <a class = "line_left">12</a>
                    <a><span>1</span></a>
                    <a><span>2</span></a>
                    <a><span>3</span></a>
                    <a><span>4</span></a>
                    <a><span>5</span></a>
                    <a><span>6</span></a>
                    <a><span>7</span></a>
                    <a><span>8</span></a>
                    <a><span>9</span></a>
                    <a><span>10</span></a>
                    <a><span>11</span></a>
                    <a><span>12</span></a>
                    <a class = "line_right">12</a>
                </div>
            </div>
            <div></div>

            <div></div>
            <div class = "footer">
            </div>
            <div></div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src = "{{ URL::asset('js/script.js') }}"></script>
        <script src = "{{ URL::asset('js/slider.js') }}"></script>
    </body>
</html>
