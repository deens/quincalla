<?php

use Illuminate\Database\Seeder;
use Quincalla\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::create(
            [
                'name' => 'John Doe', 
                'email' => 'john@example.com', 
                'password' => Hash::make('password')
            ]
        );
    }

}
