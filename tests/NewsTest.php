<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class NewsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNewsChapter()
    {
        $this->visit('/admin/chapter')                          // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/chapter/create?sType=0')        // Должны непейти на данный адрес 
            ->type('Раздел Новостей', 'title')                  // Заполняем поле "title"
            ->type('This is description', 'description')
            ->type('1', 'pos')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_active')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/chapter')
            ->seeInDatabase('chapters', ['title' => 'Раздел Новостей'])
            ->assertResponseOk();                               // Проверяем прошел ли тест
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNews()
    {
        $this->visit('/admin/news')
            ->see( Lang::get('table_field.toolbar.add') )
            ->click( Lang::get('table_field.toolbar.add') )
            ->seePageIs('/admin/news/create')
            ->type('This test news', 'title')
            ->type('this_test_news', 'url')
            ->type(get_formatted_date(Carbon\Carbon::now()), 'date')
            ->type('This news created testing', 'content')
            ->type('Unit Testing', 'tags')
            ->select('3', 'chapter_id')
            ->type('Unit Testing', 'source')
            ->check('necessarily')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
            ->type( Config::get('constants.DONE_STATUS.FAILURE'), 'is_main')
            ->type( Config::get('constants.DONE_STATUS.FAILURE'), 'is_important')
            ->press( Lang::get('table_field.lists.save') )
            ->seePageIs('/admin/news')
            ->seeInDatabase('news', ['title' => 'This test news'])
            ->assertResponseOk();

        // $this->visit('/')
        //     ->see('This test news')
        //     ->click('This test news')
        //     ->seePageIs('/n/this_test_news')
        //     ->see('This test news')
        //     ->see('This news created testing')
        //     ->assertResponseOk();
    }
}
