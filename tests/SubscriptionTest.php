<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SubscriptionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateSubscriber()
    {
        $this->visit('/admin/subscribers')                      // Переходим на данный адрес
            ->see( Lang::get('table_field.toolbar.add') )       // Смотрим, видим ли мы кнопку "add"
            ->click( Lang::get('table_field.toolbar.add') )     // Нажимаем на неё
            ->seePageIs('/admin/subscribers/create')            // Должны непейти на данный адрес 
            ->type('mailto@mail.ii', 'email')                   // Заполняем поле "email"
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_active')
            ->press( Lang::get('table_field.lists.save') )      // Нажимаем на кнопку "save"
            ->seePageIs('/admin/subscribers')
            ->seeInDatabase('subscribers', ['email' => 'mailto@mail.ii'])
            ->assertResponseOk();                               // Проверяем прошел ли тест
    }
}
