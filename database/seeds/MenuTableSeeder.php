<?php

use Illuminate\Database\Seeder;
use App\Models\Menues as Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Menu::create([
            'id' => 1,
            'title' => 'Главная',
            'type_menu' => Menu::TYPE_MAIN,
            'is_published' => Menu::IS_PUBLISHED,
            'is_loaded_by_default' => 1,
            'pos' => 0,
            'url' => 'index',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 2,
            'title' => 'О Нас',
            'type_menu' => Menu::TYPE_MAIN,
            'is_published' => Menu::IS_PUBLISHED,
            'is_loaded_by_default' => 1,
            'pos' => 1,
            'url' => 'about',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 3,
            'title' => 'Контакты',
            'type_menu' => Menu::TYPE_MAIN,
            'is_published' => Menu::IS_PUBLISHED,
            'is_loaded_by_default' => 1,
            'pos' => 2,
            'url' => 'contact',
            'user_id' => 1
        ]);
    }
}
