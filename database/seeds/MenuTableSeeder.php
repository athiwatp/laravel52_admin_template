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
        Menu::where('id', 'like', '%%')->delete();

        Menu::create(array(
            'title'      => 'Главная',
            'type_menu'  => Menu::TYPE_MAIN,
            'pos'  => 0,
            'is_published'  => '1',
            'is_loaded_by_default'  => '1'
        ));
    }
}
