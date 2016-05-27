<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRegisterAndLoginUser()
    {
        $this->visit('/admin/users')
            ->see( Lang::get('table_field.toolbar.add') )
            ->click( Lang::get('table_field.toolbar.add') )
            ->seePageIs('/admin/users/create')
            ->type('Makss', 'name')
            ->type('makss_18@mail.ru', 'email')
            ->type('123456', 'password')
            ->type('123456', 'password_confirmation')
            ->select('2', 'group')
            ->press( Lang::get('users.reg.register') )
            ->seePageIs('/admin/users')
            ->seeInDatabase('users', ['email' => 'makss_18@mail.ru'])
            ->assertResponseOk();

        $this->visit('/admin')
            ->see( Lang::get('layouts.layouts.logout') )
            ->click( Lang::get('layouts.layouts.logout') )
            ->seePageIs('/login')
            ->type('makss_18@mail.ru', 'email')
            ->type('123456', 'password')
            ->press( Lang::get('users.auth.login') )
            ->seePageIs('/admin')
            ->see( Lang::get('users.form.profile') )
            ->click( Lang::get('users.form.profile') )
            ->seePageIs('/admin/users/2/edit')
            ->type('Makss', 'name')
            ->type('makss_18@mail.ru', 'email')
            ->type('0961305500', 'phone')
            ->select('2', 'group')
            ->press( Lang::get('table_field.lists.save') )
            ->seePageIs('/admin/users')
            ->seeInDatabase('users', ['phone' => '0961305500'])
            ->assertResponseOk();
    }
}
