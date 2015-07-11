<?php

use Illuminate\Database\Seeder;
use Quincalla\Entities\Product;

class ProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('products')->delete();
        Product::insert($this->products());
        factory('Quincalla\Entities\Product', 50)->create();
    }

    public function products()
    {
        return [
            [
                'name' => 'First Necklace Yellow Gold',
                'slug' => 'first-necklace-yellow-gold',
                'description' => 'Awesome Yellow Gold Necklace Description',
                'picture' => 'first-nacklace-yellow-gold.png',
                'price' => '99,99',
                'compare_price' => '69.99',
                'type' => 'Necklace',
                'vendor' => 'Start Jeweley',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
                'published' => true
            ]
        ];
    }

}

