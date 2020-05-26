<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Films;
use App\Slider;
use App\SessionTime;
use App\Cinema;
use App\Bonuses;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $description = 'Паша, сербский сердцеед и весельчак, — хозяин пятизвездочного отеля в Белграде. Он живет, не зная бед, пока однажды совершенно случайно не портит новое — многомиллионное! — приобретение коллекционера-мафиози. В уплату долга криминальный босс заставляет Пашу жениться на своей дочке. Девушка начинает рьяно готовиться к свадьбе с красавчиком отельером, когда Паша после четырехлетней разлуки неожиданно сталкивается с Дашей, своей русской любовью. В романтичной атмосфере древнего города чувства между ними готовы вспыхнуть вновь…если бы не будущий тесть, настоящий муж, слепой дед и друг-банкрот!..';
        $belarusCinema = json_encode([
            1 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ],
            2 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ],
            3 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ],
            4 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ],
            5 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ],
            6 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ],
            7 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ],
            8 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ],
            9 => [
                1 => 0,
                2 => 0,
                3 => 0,
                4 => 0,
                5 => 0,
                6 => 0,
                7 => 0,
                8 => 0,
                9 => 0,
                10 => 0
            ] 
        ]);

        Bonuses::insert([
            [
                'name' => 'Скидка на билет 5%',
                'days_active' => 45
            ],
            [
                'name' => 'Скидка на ассортимент бара 5%',
                'days_active' => 30
            ]
        ]);

        $lohotronCinema = $belarusCinema;

        Cinema::insert([
            [
                'name' => 'Лохотрон', 
                'halls' => json_encode([
                    'Малый' => $belarusCinema, 
                    'Большой' => $belarusCinema
                ]),
                'cinema_image' => 'img/cinema_page/belarus.jpg',
                'date_created' => date('Y-m-d'),
                'description' => 'Найс киноеатр',
                'terminal' => true,
                'bar' => true,
                'parking' => true,
                'metro' => 'Автозаводская',
                'phones' => '+375296530221'
            ],
            [
                'name' => 'Беларусь', 
                'halls' => json_encode([
                    'Малый' => $belarusCinema, 
                    'Большой' => $belarusCinema
                ]),
                'cinema_image' => 'img/cinema_page/belarus.jpg',
                'date_created' => date('Y-m-d'),
                'description' => 'Найс киноеатр',
                'terminal' => true,
                'bar' => true,
                'parking' => true,
                'metro' => 'Автозаводская',
                'phones' => '+375296530221'
            ]
        ]);
        
        Role::create(['role_name' => 'admin']);
        Role::create(['role_name' => 'user']);
        Role::create(['role_name' => 'manager']);

        $adminRole = Role::where('role_name', 'admin')->first();
        $managerRole = Role::where('role_name', 'manager')->first();
        $userRole = Role::where('role_name', 'user')->first();

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'api_token' => Str::random(60)
        ]);

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('manager'),
            'api_token' => Str::random(60)
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'api_token' => Str::random(60)
        ]);

        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);
        $user->roles()->attach($userRole);

        Films::insert([
            [
                'name' => 'Нотр-дам',
                'preview_image' => 'img/film_previews/notrdam.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Триллер',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
            [
                'name' => 'Джентельмены',
                'preview_image' => 'img/film_previews/gentelmans.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Комедия',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
            [
                'name' => 'Дылда',
                'preview_image' => 'img/film_previews/dilda.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Драма',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
            [
                'name' => 'Идеальные незнакомцы',
                'preview_image' => 'img/film_previews/unknowns.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Комедия',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
            [
                'name' => 'Во всё тяжкое',
                'preview_image' => 'img/film_previews/hard.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Триллер',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
            [
                'name' => 'Хороший доктор',
                'preview_image' => 'img/film_previews/good_doctor.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Комедия',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
            [
                'name' => 'Вельзевул',
                'preview_image' => 'img/film_previews/velzevul.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Ужасы',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
            [
                'name' => 'Нотр-Дам',
                'preview_image' => 'img/film_previews/notrdam.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Документальный фильм',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
            [
                'name' => 'Странники терпенья',
                'preview_image' => 'img/film_previews/stand.jpg',
                'film_page_image' => 'img/film_page/example.jpg',
                'description' => $description,
                'genre' => 'Комедия',
                'date_shown_from' => date('Y-m-d'),
                'date_shown_to' => date('Y-m-d', strtotime(date('Y-m-d').' +7 days')),
                'country' => 'Россия',
                'year' => '2020',
                'duration' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restriction' => '18+',
                'trailer' => 'https://www.youtube.com/embed/1ZV0WoipyC4',
                'is_shown' => 1
            ],
        ]);

        Slider::insert([
            ['slider_image' => 'img/film_slider/nice_1.jpg'],
            ['slider_image' => 'img/film_slider/nice_2.jpg']
        ]);

        SessionTime::insert([
            [
                'film_id' => 1,
                'date_shown' => date('Y-m-d'),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 1,
                'date_shown' => date('Y-m-d'),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 1,
                'date_shown' => date('Y-m-d', strtotime('+1 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 2,
                'date_shown' => date('Y-m-d', strtotime('+1 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00 +1 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 2,
                'date_shown' => date('Y-m-d', strtotime('+1 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00 +1 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 2,
                'date_shown' => date('Y-m-d', strtotime('+1 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00 +1 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 3,
                'date_shown' => date('Y-m-d', strtotime('+1 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00 +1 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 3,
                'date_shown' => date('Y-m-d', strtotime('+2 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00 +2 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 3,
                'date_shown' => date('Y-m-d', strtotime('+2 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00 +2 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 4,
                'date_shown' => date('Y-m-d', strtotime('+2 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00 +2 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 4,
                'date_shown' => date('Y-m-d', strtotime('+2 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00 +2 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 4,
                'date_shown' => date('Y-m-d', strtotime('+2 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00 +2 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 5,
                'date_shown' => date('Y-m-d', strtotime('+2 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00 +2 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 5,
                'date_shown' => date('Y-m-d', strtotime('+2 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00 +2 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 5,
                'date_shown' => date('Y-m-d', strtotime('+2 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00 +2 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 6,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00 +3 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 6,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00 +3 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 6,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00 +3 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 7,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00 +3 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 7,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00 +3 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 7,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00 +3 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 8,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00 +3 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 8,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00 +3 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 8,
                'date_shown' => date('Y-m-d', strtotime('+3 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00 +3 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 9,
                'date_shown' => date('Y-m-d', strtotime('+4 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('20:00 +4 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 9,
                'date_shown' => date('Y-m-d', strtotime('+4 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('21:00 +4 days')),
                'cinema_name' => 'Лохотрон',
                'cinema_id' => 1,
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 9,
                'date_shown' => date('Y-m-d', strtotime('+4 days')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('22:00 +4 days')),
                'cinema_name' => 'Беларусь',
                'cinema_id' => 2,
                'hall_places' => json_encode($belarusCinema)
            ]
        ]);
    }
}
