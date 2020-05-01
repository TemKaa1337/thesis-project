<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Films;
use App\Slider;
use App\SessionTime;
use App\Cinema;

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

        $lohotronCinema = $belarusCinema;

        Cinema::insert([
            ['name' => 'Лохотрон'],
            ['name' => 'Беларусь']
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
            'password' => bcrypt('admin')
        ]);

        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@manager.com',
            'password' => bcrypt('manager')
        ]);

        $user = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('user')
        ]);

        $admin->roles()->attach($adminRole);
        $manager->roles()->attach($managerRole);
        $user->roles()->attach($userRole);

        Films::insert([
            [
                'name' => 'Я вcе еще верю 1',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'name' => 'Я вcе еще верю 2',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'name' => 'Я вcе еще верю 3',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'name' => 'Я вcе еще верю 4',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'name' => 'Я вcе еще верю 5',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'name' => 'Я вcе еще верю 6',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'name' => 'Я вcе еще верю 7',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'name' => 'Я вcе еще верю 8',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'name' => 'Я вcе еще верю 9',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
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
                'date_shown' => date('Y-m-d', strtotime('2020-05-01')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-01 20:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 1,
                'date_shown' => date('Y-m-d', strtotime('2020-05-01')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-01 21:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 1,
                'date_shown' => date('Y-m-d', strtotime('2020-05-02')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-02 22:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 2,
                'date_shown' => date('Y-m-d', strtotime('2020-05-02')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-02 20:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 2,
                'date_shown' => date('Y-m-d', strtotime('2020-05-02')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-02 21:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 2,
                'date_shown' => date('Y-m-d', strtotime('2020-05-02')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-02 22:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 3,
                'date_shown' => date('Y-m-d', strtotime('2020-05-02')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-02 20:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 3,
                'date_shown' => date('Y-m-d', strtotime('2020-05-03')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-03 21:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 3,
                'date_shown' => date('Y-m-d', strtotime('2020-05-03')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-03 22:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 4,
                'date_shown' => date('Y-m-d', strtotime('2020-05-03')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-03 20:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 4,
                'date_shown' => date('Y-m-d', strtotime('2020-05-03')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-03 21:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 4,
                'date_shown' => date('Y-m-d', strtotime('2020-05-03')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-03 22:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 5,
                'date_shown' => date('Y-m-d', strtotime('2020-05-03')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-03 20:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 5,
                'date_shown' => date('Y-m-d', strtotime('2020-05-03')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-03 21:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 5,
                'date_shown' => date('Y-m-d', strtotime('2020-05-03')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-03 22:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 6,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 20:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 6,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 21:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 6,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 22:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 7,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 20:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 7,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 21:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 7,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 22:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 8,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 20:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 8,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 21:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 8,
                'date_shown' => date('Y-m-d', strtotime('2020-05-04')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-04 22:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ],
            [
                'film_id' => 9,
                'date_shown' => date('Y-m-d', strtotime('2020-05-05')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-05 20:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 9,
                'date_shown' => date('Y-m-d', strtotime('2020-05-05')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-05 21:00')),
                'cinema_name' => 'Лохотрон',
                'hall_places' => json_encode($lohotronCinema)
            ],
            [
                'film_id' => 9,
                'date_shown' => date('Y-m-d', strtotime('2020-05-05')),
                'datetime_shown' => date('Y-m-d H:i', strtotime('2020-05-05 22:00')),
                'cinema_name' => 'Беларусь',
                'hall_places' => json_encode($belarusCinema)
            ]
        ]);
    }
}
