<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        putenv('DB_DEFAULT=sqlite_testing');

        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function setUp()
    {
        parent::setUp();
        Artisan::call('view:clear');
        // Artisan::call('migrate');
        // Artisan::call('db:seed');


        $this->visit('login')                       // Переходим на панный адрес
            ->type('admin@pervosoft.com', 'email')  // Заполняем поле "email"
            ->type('pervosoft', 'password')         // Заполняем поле "password"
            ->press( Lang::get('users.auth.login') )// Жмякаем на кнопку "login"
            ->seePageIs('/admin')                   // Система должна переадресовать на данный адрес
            ->assertResponseOk();                   // Проверяем успешность теста

    }

    // public function tearDown()
    // {
       // Artisan::call('migrate:reset');
    //    parent::tearDown();
    // }
}
