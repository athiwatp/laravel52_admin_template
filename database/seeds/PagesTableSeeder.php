<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Pages as Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $constants = Config::get('constants');

        Page::where('id', 'like', '%%')->delete();

        $faker = Faker::create('ru_RU');

        Page::insert([
            // Main page
            [
                'id' => 1,
                'title' => 'Головна',
                'url' => '1',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 2,
                'title' => 'Знайомство с містом',
                'url' => '2',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 3,
                'title' => 'Місто офіційне',
                'url' => '3',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 4,
                'title' => 'Економіка',
                'url' => '4',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 5,
                'title' => 'Гуманітарна сфера',
                'url' => '5',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 6,
                'title' => 'Туризм',
                'url' => '6',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 7,
                'title' => 'Електронне звернення',
                'url' => '7',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 8,
                'title' => 'Web-камери',
                'url' => '8',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 9,
                'title' => 'Обговорюємо законопроект',
                'url' => '9',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 10,
                'title' => 'Європейська та євроатлантична інтеграція',
                'url' => '10',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 11,
                'title' => 'Краєвиди міста',
                'url' => '11',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 12,
                'title' => 'Доступ до публічної інформації',
                'url' => '12',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 13,
                'title' => 'Система управління якістю',
                'url' => '13',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 14,
                'title' => 'Реформи в Україні',
                'url' => '14',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 15,
                'title' => '„Партнерство „Відкритий Уряд”',
                'url' => '15',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 16,
                'title' => 'Протидія корупції',
                'url' => '16',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],

            [
                'id' => 17,
                'title' => 'Гостьова книга',
                'url' => '17',
                'content' => $faker->text,
                'is_published' => $constants['DONE_STATUS']['SUCCESS'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime,
                'user_id' => 1
            ],
        ]);

    }
}
