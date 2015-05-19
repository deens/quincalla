<?php

use Illuminate\Database\Seeder;
use Quincalla\Collection;

class CollectionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('collections')->delete();
        Collection::insert([
            [
                'name' => 'Necklaces', 
                'slug' => 'necklaces', 
            ],
            [
                'name' => 'Pendants', 
                'slug' => 'pendants', 
            ],
            [
                'name' => 'Rings', 
                'slug' => 'rings', 
            ],
            [
                'name' => 'Bracelets', 
                'slug' => 'bracelets', 
            ],
            [
                'name' => 'Earrings', 
                'slug' => 'earrings', 
            ]
        ]);
    }

}

