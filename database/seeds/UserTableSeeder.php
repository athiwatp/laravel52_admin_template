<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
                'name'      => 'Admin',
                'email'     => 'admin@pervosoft.com',
                'password'  => Hash::make('pervosoft'),
                'is_admin'  => '1',
                'phone'     => 'admin123',
                'is_verified' => '1'
            ));

    }
}
