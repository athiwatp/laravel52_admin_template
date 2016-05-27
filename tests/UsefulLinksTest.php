<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsefulLinksTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUsefulLinksChapter()
    {
        $this->visit('/admin/chapter/useful-links')             // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/chapter/create?sType=3')        // Должны непейти на данный адрес 
            ->type('Раздел Полезных ссылок', 'title')           // Заполняем поле "title"
            ->type('This is description', 'description')
            ->type('1', 'pos')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_active')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/chapter/useful-links')
            ->seeInDatabase('chapters', ['title' => 'Раздел Полезных ссылок'])
            ->assertResponseOk();                               // Проверяем прошел ли тест
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateUsefulLinks()
    {
        $this->visit('/admin/usefulLinks')                      // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/usefulLinks/create')            // Должны непейти на данный адрес 
            ->type('Президент України', 'title')                // Заполняем поле "title"
            ->type('http://www.president.gov.ua/', 'url')
            ->select('4', 'chapter_id')
            ->type('This is description', 'description')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_active')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/usefulLinks')
            ->seeInDatabase('useful_links', ['title' => 'Президент України'])
            ->assertResponseOk();                               // Проверяем прошел ли тест

        // $this->visit('/')
        //     ->see('Раздел Полезных ссылок')
        //     ->see('Президент України')
        //     ->click('Президент України')
        //     ->seePageIs('http://www.president.gov.ua/')
        //     ->assertResponseOk();
    }
}
