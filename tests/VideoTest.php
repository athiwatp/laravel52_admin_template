<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VideoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateVideoNews()
    {
        $this->visit('/admin/videoNews')             // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/videoNews/create')        // Должны непейти на данный адрес 
            ->type('Евровидение', 'title')           // Заполняем поле "title"
            ->type('evrovidenie', 'url')
            ->type('https://www.youtube.com/watch?v=cUrbAbzMHxA', 'youtube_url')
            ->type(get_formatted_date(Carbon\Carbon::now()), 'date')
            ->type('Джамала (Евровидение)', 'content')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/videoNews')
            ->seeInDatabase('video_news', ['title' => 'Евровидение'])
            ->assertResponseOk();                               // Проверяем прошел ли тест

        // $this->visit('/')
        //     ->see( Lang::get('layouts.video_archive') )
        //     ->click( Lang::get('layouts.video_archive') )
        //     ->see('Евровидение')
        //     ->click('Евровидение')
        //     ->seePageIs('/v/1')
        //     ->assertResponseOk();
    }
}
