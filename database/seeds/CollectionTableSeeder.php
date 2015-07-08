<?php

use Illuminate\Database\Seeder;
use Quincalla\Entities\Collection;

class CollectionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('collections')->delete();
        Collection::insert([
            [
                'name' => 'Necklaces', 
                'slug' => 'necklaces', 
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'Pendants', 
                'slug' => 'pendants', 
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'Rings', 
                'slug' => 'rings', 
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'Bracelets', 
                'slug' => 'bracelets', 
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
            [
                'name' => 'Earrings', 
                'slug' => 'earrings', 
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        ]);
    }

}

