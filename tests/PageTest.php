<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PageTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreatePublishedPage()
    {
        $this->visit('/admin/pages')                            // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/pages/create')                  // Должны пепейти на данный адрес 
            ->type('This is a First test page', 'title')        // Заполняем поле "title" -> текстом "This is a First test page"
            ->type('this_is_a_first_test_page', 'url')          // Заполняем поле "url" -> текстом "this_is_a_first_test_page"
            ->type('First test page', 'subtitle')
            ->type('This is a my first create page for unit tests', 'content')
            ->type('This is Meta Keywords', 'meta_keywords')
            ->type('This is Meta Descriptions', 'meta_descriptions')
            ->type(Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/pages')
            ->seeInDatabase('static_pages', ['title' => 'This is a First test page'])
            ->assertResponseOk();                               // Проверяем прошел ли тест

        // $this->visit('/s/this_is_a_first_test_page')            // Переходим на данный адрес
        //     ->see('This is a First test page')                  // Должны увидеть данный текст
        //     ->see('This is a my first create page for unit tests')
        //     ->assertResponseOk();                               // Проверяем прошел ли тест
    }

    /**
     * A basic test example.
     * 
     * This create page and not published 
     *
     * @return void
     */
    public function testCreateNotPublishedPage()
    {
        $this->visit('/admin/pages')                            // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/pages/create')                  // Должны непейти на данный адрес 
            ->type('Создание второй страницы', 'title')         // Заполняем поле "title" -> текстом "This is a First test page"
            ->type('sozdanie_vtoroy_stranitsy', 'url')          // Заполняем поле "url"
            ->type('Вторая страница тестов', 'subtitle')
            ->type('Это моя врорая страница созданная с помощью тестов', 'content')
            ->type('Вторая страница', 'meta_keywords')
            ->type('Вторая страница', 'meta_descriptions')
            ->type( Config::get('constants.DONE_STATUS.FAILURE'), 'is_published')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/pages')
            ->seeInDatabase('static_pages', ['title' => 'Создание второй страницы'])
            ->assertResponseOk();                               // Проверяем прошел ли тест

        // $this->visit('/s/sozdanie_vtoroy_stranitsy')            // Переходим на данный адрес
        //     ->seePageIs('/')
        //     ->assertResponseOk();                               // Проверяем прошел ли тест
    }

    /**
     * A basic test example.
     * 
     * This create page and not published 
     *
     * @return void
     */
    public function testEditPublishedPage()
    {
        $this->visit('/admin/pages/1/edit')                     // Переходим на данный адрес
            ->see('This is a First test page')                  // Смотрим, видим ли мы данную запись
            ->type('Это первая тестовая страница', 'title')     // Заполняем поле "title"
            ->type('eto_pervaya_testovaya_stranitsa', 'url')    // Заполняем поле "url"
            ->type('Первая тестовая страница', 'subtitle')
            ->type('Это моя первая страница для создания модульных тестов', 'content')
            ->type('Это Мета ключевые слова', 'meta_keywords')
            ->type('Это метаописаниях', 'meta_descriptions')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
            ->press( Lang::get('table_field.lists.save') )      // Жмякаем на кнопку "save"
            ->seePageIs('/admin/pages')                         // Переходим на данный адрес
            ->seeInDatabase('static_pages', ['title' => 'Это первая тестовая страница'])  // Проверяем созданую запись в Базу данных
            ->assertResponseOk();                               // Проверяем прошел ли тест

        // $this->visit('/s/eto_pervaya_testovaya_stranitsa')      // Переходим на данный адрес
        //     ->see('Это первая тестовая страница')               // Смотрим, видим ли мы данный текст
        //     ->see('Это моя первая страница для создания модульных тестов')
        //     ->assertResponseOk();

        // $this->visit('/s/this_is_a_first_test_page')            // Переходим на старый адрес страницы
        //     ->see('Это первая тестовая страница')               // Смотрим, видим ли мы данный текст
        //     ->see('Это моя первая страница для создания модульных тестов')
        //     ->assertResponseOk();
    }

    public function testCreateMenuAndThisPage()
    {
        $this->visit('/admin/menu')
            ->see( Lang::get('table_field.toolbar.add') )
            ->click( Lang::get('table_field.toolbar.add') )
            ->seePageIs('/admin/menu/create')
            ->type('Test menu', 'title')
            ->type('test_menu', 'url')
            ->select('M', 'type_menu')
            ->type('3', 'pos')
            ->type('0', 'parent_id')
            ->select('1', 'page_id')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
            ->press( Lang::get('table_field.lists.save') )
            ->seePageIs('/admin/menu')
            ->seeInDatabase('static_menues', ['title' => 'Test menu'])
            ->assertResponseOk();

        // $this->visit('/')
        //     ->see('Test menu')
        //     ->click('Test menu')
        //     ->seePageIs('/s/eto_pervaya_testovaya_stranitsa')
        //     ->see('Это первая тестовая страница')
        //     ->see('Это моя первая страница для создания модульных тестов')
        //     ->assertResponseOk();
    }

}
