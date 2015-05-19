<?php

use Illuminate\Database\Seeder;
use Quincalla\Product;

class ProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('products')->delete();
        Product::insert([
            ['collection_id' => 1, 'name' => 'First Necklace Yellow Gold', 'slug' => 'first-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Second Necklace Yellow Gold', 'slug' => 'second-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Third Necklace Yellow Gold', 'slug' => 'third-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Fourth Necklace Yellow Gold', 'slug' => 'fourth-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Fifth Necklace Yellow Gold', 'slug' => 'fifth-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Sixth Necklace Yellow Gold', 'slug' => 'sixth-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Seventh Necklace Yellow Gold', 'slug' => 'seventh-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Eighth Necklace Yellow Gold', 'slug' => 'eighth-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Ninth Necklace Yellow Gold', 'slug' => 'ninth-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Tenth Necklace Yellow Gold', 'slug' => 'tenth-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Eleventh Necklace Yellow Gold', 'slug' => 'eleventh-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],
            ['collection_id' => 1, 'name' => 'Twelfth Necklace Yellow Gold', 'slug' => 'twelfth-necklace-yellow-gold', 'price' => '99,00', 'description' => 'Awesome Yellow Gold Necklace Description', 'picture' => '' ],

            ['collection_id' => 2, 'name' => 'First Pendant Yellow Gold', 'slug' => 'first-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Second Pendant Yellow Gold', 'slug' => 'second-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Third Pendant Yellow Gold', 'slug' => 'third-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Fourth Pendant Yellow Gold', 'slug' => 'fourth-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Fifth Pendant Yellow Gold', 'slug' => 'fifth-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Sixth Pendant Yellow Gold', 'slug' => 'sixth-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Seventh Pendant Yellow Gold', 'slug' => 'seventh-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Eighth Pendant Yellow Gold', 'slug' => 'eighth-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Ninth Pendant Yellow Gold', 'slug' => 'ninth-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Tenth Pendant Yellow Gold', 'slug' => 'tenth-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Eleventh Pendant Yellow Gold', 'slug' => 'eleventh-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Twelfth	Pendant Yellow Gold', 'slug' => 'twelfth-pendant-yellow-gold', 'price' => '114.99', 'description' => 'Fantastic Yellow Gold Pendant Description', 'picture' => ''],

            ['collection_id' => 2, 'name' => 'First Pendant Silver', 'slug' => 'first-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Second Pendant Silver', 'slug' => 'second-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Third Pendant Silver', 'slug' => 'third-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Fourth Pendant Silver', 'slug' => 'fourth-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Fifth Pendant Silver', 'slug' => 'fifth-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Sixth Pendant Silver', 'slug' => 'sixth-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Seventh Pendant Silver', 'slug' => 'seventh-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Eighth Pendant Silver', 'slug' => 'eighth-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Ninth Pendant Silver', 'slug' => 'ninth-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Tenth Pendant Silver', 'slug' => 'tenth-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Eleventh Pendant Silver', 'slug' => 'eleventh-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],
            ['collection_id' => 2, 'name' => 'Twelfth	Pendant Silver', 'slug' => 'twelfth-pendant-silver', 'price' => '79.99', 'description' => 'Great Pendant Silver Description', 'picture' => ''],

            ['collection_id' => 3, 'name' => 'First Ring Rose Gold', 'slug' => 'first-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''],
            ['collection_id' => 3, 'name' => 'Second Ring Rose Gold', 'slug' => 'second-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Third Ring Rose Gold', 'slug' => 'third-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Fourth Ring Rose Gold', 'slug' => 'fourth-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Fifth Ring Rose Gold', 'slug' => 'fifth-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Sixth Ring Rose Gold', 'slug' => 'sixth-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Seventh Ring Rose Gold', 'slug' => 'seventh-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Eighth Ring Rose Gold', 'slug' => 'eighth-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Ninth Ring Rose Gold', 'slug' => 'ninth-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Tenth Ring Rose Gold', 'slug' => 'tenth-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Eleventh Ring Rose Gold', 'slug' => 'eleventh-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 
            ['collection_id' => 3, 'name' => 'Twelfth Ring Rose Gold', 'slug' => 'twelfth-ring-rose-gold', 'price' => '67.00', 'description' => 'Beautiful Rose Gold Ring Description', 'picture' => ''], 

            ['collection_id' => 4, 'name' => 'First Bracelet Yellow Gold', 'slug' => 'first-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Second Bracelet Yellow Gold', 'slug' => 'second-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Third Bracelet Yellow Gold', 'slug' => 'third-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Fourth Bracelet Yellow Gold', 'slug' => 'fourth-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Fifth Bracelet Yellow Gold', 'slug' => 'fifth-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Sixth Bracelet Yellow Gold', 'slug' => 'sixth-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Seventh Bracelet Yellow Gold', 'slug' => 'seventh-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Eighth Bracelet Yellow Gold', 'slug' => 'eighth-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Ninth Bracelet Yellow Gold', 'slug' => 'ninth-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Tenth Bracelet Yellow Gold', 'slug' => 'tenth-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Eleventh Bracelet Yellow Gold', 'slug' => 'eleventh-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],
            ['collection_id' => 4, 'name' => 'Twelfth Bracelet Yellow Gold', 'slug' => 'twelfth-bracelet-yellow-gold', 'price' => '219.00', 'description' => 'Beautiful Yellow Gold Bracelet Description', 'picture' => ''],

            ['collection_id' => 5, 'name' => 'First Earrings Yellow Gold', 'slug' => 'first--earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Second Earrings Yellow Gold', 'slug' => 'second-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Third Earrings Yellow Gold', 'slug' => 'third-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Fourth Earrings Yellow Gold', 'slug' => 'fourth-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Fifth Earrings Yellow Gold', 'slug' => 'fifth-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Sixth Earrings Yellow Gold', 'slug' => 'sixth-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Seventh Earrings Yellow Gold', 'slug' => 'seventh-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Eighth Earrings Yellow Gold', 'slug' => 'eighth-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Ninth Earrings Yellow Gold', 'slug' => 'ninth-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Tenth Earrings Yellow Gold', 'slug' => 'tenth-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Eleventh Earrings Yellow Gold', 'slug' => 'eleventh-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Twelfth Earrings Yellow Gold', 'slug' => 'twelfth-earrings-yellow-gold', 'price' => '59.00', 'description' => 'Stunning Yellow Gold Earrings Description', 'picture' => ''],

            ['collection_id' => 5, 'name' => 'First Earrings Titanium', 'slug' => 'first--earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Second Earrings Titanium', 'slug' => 'second-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Third Earrings Titanium', 'slug' => 'third-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Fourth Earrings Titanium', 'slug' => 'fourth-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Fifth Earrings Titanium', 'slug' => 'fifth-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Sixth Earrings Titanium', 'slug' => 'sixth-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Seventh Earrings Titanium', 'slug' => 'seventh-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Eighth Earrings Titanium', 'slug' => 'eighth-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Ninth Earrings Titanium', 'slug' => 'ninth-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Tenth Earrings Titanium', 'slug' => 'tenth-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Eleventh Earrings Titanium', 'slug' => 'eleventh-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
            ['collection_id' => 5, 'name' => 'Twelfth Earrings Titanium', 'slug' => 'twelfth-earrings-titanium', 'price' => '59.00', 'description' => 'Stunning Titanium Earrings Description', 'picture' => ''],
        ]);
    }

}

