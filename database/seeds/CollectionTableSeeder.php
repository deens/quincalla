<?php

use Illuminate\Database\Seeder;
use Quincalla\Entities\Collection;

class CollectionTableSeeder extends Seeder {

    public function run()
    {
        DB::table('collections')->delete();
        Collection::create([
            'name' => 'Frontpage',
            'slug' => 'frontpage',
            'type' => 'manual',
            'published' => false,
            'created_at' => new DateTime(),
            'updated_at' => new DateTime()
        ]);
    }

}

