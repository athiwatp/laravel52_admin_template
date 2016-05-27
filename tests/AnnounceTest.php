<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AnnounceTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateAnnounceChapter()
    {
        $this->visit('/admin/chapter/announcements')            // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/chapter/create?sType=2')        // Должны непейти на данный адрес 
            ->type('Раздел Анонсов', 'title')                   // Заполняем поле "title"
            ->type('This is description', 'description')
            ->type('1', 'pos')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_active')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/chapter/announcements')
            ->seeInDatabase('chapters', ['title' => 'Раздел Анонсов'])
            ->assertResponseOk();                               // Проверяем прошел ли тест
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatePublishedAnnouncement()
    {
        $this->visit('/admin/announcements')                    // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/announcements/create')          // Должны пепейти на данный адрес 
            ->type('This is a First test page', 'title')        // Заполняем поле "title"
            ->check('is_topical')
            ->type(get_formatted_date(Carbon\Carbon::now()->addWeek()), 'top_date_end')
            ->type('23/05/2016', 'date_start')
            ->type('23/06/2016', 'date_end')
            ->type('This announcement is created by testing', 'description')
            ->select('1', 'chapter_id')
            ->type(Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/announcements')
            ->seeInDatabase('announcement', ['title' => 'This is a First test page'])
            ->assertResponseOk();                               // Проверяем прошел ли тест

        // $this->visit('/')                                       // Переходим на данный адрес
        //     ->see('This is a First test page')                  // Должны увидеть данный текст
        //     ->click('This is a First test page')
        //     ->seePageIs('/a/1')
        //     ->see('Раздел Анонсов')
        //     ->see('This announcement is created by testing')
        //     ->assertResponseOk();                               // Проверяем прошел ли тест
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testCreatePublishedImportantAnnouncement()
    // {
    //     $pathToFile = base_path('resources/assets/images/logo.png');

    //     $this->visit('/admin/announcements')                    // Переходим на данный адрес
    //         ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
    //         ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
    //         ->seePageIs('/admin/announcements/create')          // Должны пепейти на данный адрес 
    //         ->type('This is a First test page', 'title')        // Заполняем поле "title"
    //         ->check('important')
    //         ->type('23/05/2016', 'date_start')
    //         ->type('23/06/2016', 'date_end')
    //         ->type('This announcement is created by testing', 'description')
    //         ->select('1', 'chapter_id')
    //         ->attach($pathToFile, 'image')
    //         ->type(Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
    //         ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
    //         ->seePageIs('/admin/announcements')
    //         ->seeInDatabase('announcement', ['title' => 'This is a First test page'])
    //         ->assertResponseOk();                               // Проверяем прошел ли тест

    //     $this->visit('/a/1')                                    // Переходим на данный адрес
    //         ->see('This is a First test page')
    //         ->see('This announcement is created by testing')
    //         ->assertResponseOk();                               // Проверяем прошел ли тест
    // }

}
