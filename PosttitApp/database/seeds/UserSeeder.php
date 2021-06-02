<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        App\User::create([
            'id' => 1,
            'name' => 'Onur Ereren',
            'email' => 'onurereren@hotmail.com',
            'username' => 'oereren',
            'password' => '12345678Test@',


        ]);
    }
}
