<?php

use Illuminate\Database\Seeder;
use Quincalla\Entities\User;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::insert([
            [
                'role'       => 'admin',
                'name'       => 'John Doe',
                'email'      => 'john@example.com',
                'password'   => Hash::make('password'),
                'active'     => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'role'       => 'customer',
                'name'       => 'Jack Smith',
                'email'      => 'jack@example.com',
                'password'   => Hash::make('password'),
                'active'     => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'role'       => 'customer',
                'name'       => 'Jim Start',
                'email'      => 'jim@example.com',
                'password'   => Hash::make('password'),
                'active'     => false,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'role'       => 'guest',
                'name'       => 'Ana Tar',
                'email'      => 'ana@example.com',
                'password'   => '',
                'active'     => false,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ]);
    }
}
