<?php

use Illuminate\Database\Seeder;
use Quincalla\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();
        User::insert([
            [
                'role' => 'admin',
                'name' => 'John Doe', 
                'email' => 'john@example.com', 
                'password' => Hash::make('password'),
                'active' => true,
            ],
            [
                'role' => 'customer',
                'name' => 'Jack Smith', 
                'email' => 'jack@example.com', 
                'password' => Hash::make('password'),
                'active' => true,
            ],
            [
                'role' => 'customer',
                'name' => 'Jim Start', 
                'email' => 'jim@example.com', 
                'password' => Hash::make('password'),
                'active' => false,
            ],
            [
                'role' => 'guest',
                'name' => 'Ana Tar', 
                'email' => 'ana@example.com', 
                'password' => '',
                'active' => false,
            ],
        ]);
    }

}
