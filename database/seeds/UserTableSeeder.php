<?php

use Illuminate\Database\Seeder;
use App\Models\User as User;

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
            'id' => '1',
            'name'      => 'Admin',
            'email'     => 'admin@pervosoft.com',
            'password'  => Hash::make('pervosoft'),
            'is_admin'  => '1',
            'is_verified' => '1',
            'phone'     => 'pervosoft',
        ));
    }
}
