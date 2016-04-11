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

        $this->call(PagesTableSeeder::class);
        $this->call(MenuTableSeeder::class);

        $this->call(NewsChapterTableSeeder::class);
        $this->call(NewsTableSeeder::class);

        $this->call(GalleryTableSeeder::class);

        $this->command->info('========================================');
        $this->command->info('Таблица пользователей заполнена данными!');
        $this->command->info('Таблица Статические страници - заполнена данными!');
        $this->command->info('Таблица Меню - заполнена данными!');
        $this->command->info('Таблица Разделов - заполнена данными!');
        $this->command->info('Таблица Новостей - заполнена данными!');
        $this->command->info('Таблица Геререя - заполнена данными!');
    }
}
