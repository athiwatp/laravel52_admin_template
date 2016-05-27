<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GalleryTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateGalleryChapter()
    {
        $this->visit('/admin/chapter/gallery')                  // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/chapter/create?sType=1')        // Должны непейти на данный адрес 
            ->type('Раздел Галереи', 'title')                   // Заполняем поле "title"
            ->type('This is description', 'description')
            ->type('1', 'pos')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_active')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/chapter/gallery')
            ->seeInDatabase('chapters', ['title' => 'Раздел Галереи'])
            ->assertResponseOk();                               // Проверяем прошел ли тест
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    // public function testCreateGallery()
    // {
    //     $pathToFile = base_path('resources/assets/images/petition.jpg');

    //     $this->visit('/admin/gallery')                    // Переходим на данный адрес
    //         ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
    //         ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
    //         ->seePageIs('/admin/gallery/create')          // Должны пепейти на данный адрес 
    //         ->type('Petition image', 'title')        // Заполняем поле "title"
    //         ->type('This is a petition image', 'description')
    //         ->type('1', 'pos')
    //         ->select('2', 'chapter')
    //         ->attach($pathToFile, 'filename')
    //         ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
    //         ->seePageIs('/admin/gallery')
    //         ->seeInDatabase('gallery', ['title' => 'Petition image'])
    //         ->assertResponseOk();                               // Проверяем прошел ли тест
    // }
}
