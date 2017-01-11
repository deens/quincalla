<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(CollectionTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(StatesTableSeeder::class);
    }
}
