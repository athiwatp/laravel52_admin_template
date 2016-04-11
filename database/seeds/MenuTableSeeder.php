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
        $constants = Config::get('constants');

        Menu::where('id', 'like', '%%')->delete();

        // MAIN MENU
        Menu::create([
            'id' => 1,
            'title' => 'Головна',
            'type_menu' => $constants['TYPE_MENU']['MAIN'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['SUCCESS'],
            'pos' => 0,
            'url' => 'index',
            'page_id' => 1,
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 2,
            'title' => 'Знайомство с містом',
            'type_menu' => $constants['TYPE_MENU']['MAIN'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 1,
            'url' => 'meet-to-the-city',
            'page_id' => 2,
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 3,
            'title' => 'Місто офіційне',
            'type_menu' => $constants['TYPE_MENU']['MAIN'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 2,
            'page_id' => 3,
            'url' => 'the-official-city',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 4,
            'title' => 'Економіка',
            'type_menu' => $constants['TYPE_MENU']['MAIN'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 3,
            'page_id' => 4,
            'url' => 'economica',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 5,
            'title' => 'Гуманітарна сфера',
            'type_menu' => $constants['TYPE_MENU']['MAIN'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 4,
            'page_id' => 5,
            'url' => 'gumanitarna-sfera',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 6,
            'title' => 'Туризм',
            'type_menu' => $constants['TYPE_MENU']['MAIN'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 5,
            'page_id' => 6,
            'url' => 'contact',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 7,
            'title' => 'Електронне звернення',
            'type_menu' => $constants['TYPE_MENU']['MAIN'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 6,
            'page_id' => 7,
            'url' => 'electrone-zvernennya',
            'user_id' => 1
        ]);



        // SIDEBAR MENU
        Menu::create([
            'id' => 8,
            'title' => 'Web-камери',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 0,
            'page_id' => 8,
            'url' => 'web-cameru',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 9,
            'title' => 'Обговорюємо законопроект',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 1,
            'page_id' => 9,
            'url' => 'eobgovoruemo-zakonoproekt',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 10,
            'title' => 'Європейська та євроатлантична інтеграція',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 2,
            'page_id' => 10,
            'url' => 'evropejska-ta-evroatlantuchna-integracia',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 11,
            'title' => 'Краєвиди міста',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 3,
            'page_id' => 11,
            'url' => 'kraevudu-mista',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 12,
            'title' => 'Доступ до публічної інформації',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 4,
            'page_id' => 12,
            'url' => 'dostup-do-publichnoi-informacii',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 13,
            'title' => 'Система управління якістю',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 5,
            'page_id' => 13,
            'url' => 'sustema-upravlinna-yakistu',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 14,
            'title' => 'Реформи в Україні',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 6,
            'page_id' => 14,
            'url' => 'reformu-v-ukraini',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 15,
            'title' => '„Партнерство „Відкритий Уряд”',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 7,
            'page_id' => 15,
            'url' => 'vidkrutuj-uriyad',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 16,
            'title' => 'Протидія корупції',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 8,
            'page_id' => 16,
            'url' => 'protudia-korupcii',
            'user_id' => 1
        ]);
        Menu::create([
            'id' => 17,
            'title' => 'Гостьова книга',
            'type_menu' => $constants['TYPE_MENU']['SIDE'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 0,
            'page_id' => 17,
            'url' => 'gostova-knuga',
            'user_id' => 1
        ]);

        // Footer menu
        Menu::create([
            'id' => 18,
            'title' => 'Головна',
            'type_menu' => $constants['TYPE_MENU']['FOOTER'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 0,
            'page_id' => 1,
            'url' => 'golovna-storinka-f',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 19,
            'title' => 'Знайомство з містом',
            'type_menu' => $constants['TYPE_MENU']['FOOTER'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 1,
            'page_id' => 2,
            'url' => 'city-meet-f',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 20,
            'title' => 'Економіка',
            'type_menu' => $constants['TYPE_MENU']['FOOTER'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 3,
            'page_id' => 4,
            'url' => 'economica-f',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 21,
            'title' => 'Гуманітарна сфера',
            'type_menu' => $constants['TYPE_MENU']['FOOTER'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 4,
            'page_id' => 5,
            'url' => 'gumanitarna-sfera-f',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 22,
            'title' => 'Туризм',
            'type_menu' => $constants['TYPE_MENU']['FOOTER'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 5,
            'page_id' => 6,
            'url' => 'contact-f',
            'user_id' => 1
        ]);

        Menu::create([
            'id' => 23,
            'title' => 'Електронне звернення',
            'type_menu' => $constants['TYPE_MENU']['FOOTER'],
            'is_published' => $constants['DONE_STATUS']['SUCCESS'],
            'is_loaded_by_default' => $constants['DONE_STATUS']['FAILURE'],
            'pos' => 6,
            'page_id' => 7,
            'url' => 'electrone-zvernennya-f',
            'user_id' => 1
        ]);

    }
}
