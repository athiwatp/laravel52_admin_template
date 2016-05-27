<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MenuTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateMainPage()
    {
        $this->visit('/admin/menu')
            ->see( Lang::get('table_field.toolbar.add') )
            ->click( Lang::get('table_field.toolbar.add') )
            ->seePageIs('/admin/menu/create')
            ->type('Головна', 'title')
            ->type('golovna', 'url')
            ->select('M', 'type_menu')
            ->type('1', 'pos')
            ->type('0', 'parent_id')
            ->check('is_redirectable')
            ->type('/', 'redirect_url')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
            ->press( Lang::get('table_field.lists.save') )
            ->seePageIs('/admin/menu')
            ->seeInDatabase('static_menues', ['title' => 'Головна'])
            ->assertResponseOk();

        // $this->visit('/')
        //     ->see('Головна')
        //     ->click('Головна')
        //     ->seePageIs('/')
        //     ->assertResponseOk();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateNewsPage()
    {
        $this->visit('/admin/menu')
            ->see( Lang::get('table_field.toolbar.add') )
            ->click( Lang::get('table_field.toolbar.add') )
            ->seePageIs('/admin/menu/create')
            ->type('News', 'title')
            ->type('news', 'url')
            ->select('M', 'type_menu')
            ->type('2', 'pos')
            ->type('1', 'parent_id')
            ->check('is_redirectable')
            ->type('/news', 'redirect_url')
            ->type( Config::get('constants.DONE_STATUS.SUCCESS'), 'is_published')
            ->press( Lang::get('table_field.lists.save') )
            ->seePageIs('/admin/menu')
            ->seeInDatabase('static_menues', ['title' => 'News'])
            ->assertResponseOk();

        // $this->visit('/')
        //     ->see('News')
        //     ->click('News')
        //     ->seePageIs('/news')
        //     ->assertResponseOk();
    }
}
