<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->command->info('Таблица пользователей заполнена данными!');

        $this->call(NewsChapterTableSeeder::class);
        $this->command->info('Таблица Разделов - заполнена данными!');

        $this->call(NewsTableSeeder::class);
        $this->command->info('Таблица Новостей - заполнена данными!');

        $this->call(MenuTableSeeder::class);
        $this->command->info('Таблица Меню - заполнена данными!');

    }
}
