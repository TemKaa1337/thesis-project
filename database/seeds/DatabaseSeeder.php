<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use App\Films;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
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
                'genre' => 'Триллер',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
            [
                'name' => 'Я вcе еще верю 2',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
                'genre' => 'Триллер',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
            [
                'name' => 'Я вcе еще верю 3',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
                'genre' => 'Триллер',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
            [
                'name' => 'Я вcе еще верю 4',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
                'genre' => 'Триллер',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
            [
                'name' => 'Я вcе еще верю 5',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
                'genre' => 'Триллер',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
            [
                'name' => 'Я вcе еще верю 6',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
                'genre' => 'Триллер',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
            [
                'name' => 'Я вcе еще верю 7',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
                'genre' => 'Документальный фильм',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
            [
                'name' => 'Я вcе еще верю 8',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
                'genre' => 'Драма',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
            [
                'name' => 'Я вcе еще верю 9',
                'preview_image' => 'img/film_previews/i_still_believe.jpg',
                'genre' => 'Комедия',
                'date_shown' => '28.04.2020-10.05.2020',
                'country' => 'Россия',
                'length' => '115 минут',
                'producer' => 'Рома Суровый',
                'actors' => 'Артем Комаров, Комаров Артем, Артем Комаров, Комаров Артем',
                'age_restrictions' => '18+',
                'is_shown' => 1
            ],
        ]);
    }
}
