<?php

use Illuminate\Database\Seeder;
use Quincalla\Entities\Collection;

class CollectionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('collections')->delete();
        Collection::insert($this->collections());
    }

    public function collections()
    {
        return [
            [
                'name'       => 'Frontpage',
                'slug'       => 'frontpage',
                'type'       => 'manual',
                'match'      => 'all',
                'sort_order' => 'name-asc',
                'rules'      => '',
                'published'  => false,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ], [
                'name'       => 'Photography',
                'slug'       => 'photography',
                'type'       => 'condition',
                'match'      => 'all',
                'sort_order' => 'name-asc',
                'rules'      => '[[{"column":"vendor"},{"relation":"is_equal_to"},{"condition":"Apple"}]]',
                'published'  => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ], [
                'name'       => 'Laptops',
                'slug'       => 'laptops',
                'type'       => 'condition',
                'match'      => 'all',
                'sort_order' => 'name-asc',
                'rules'      => '[[{"column":"vendor"},{"relation":"is_equal_to"},{"condition":"Nike"}]]',
                'published'  => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ], [
                'name'       => 'Cellphones',
                'slug'       => 'cellphones',
                'type'       => 'manual',
                'match'      => 'all',
                'sort_order' => '',
                'rules'      => '',
                'published'  => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ], [
                'name'       => 'Accessories',
                'slug'       => 'accessories',
                'type'       => 'manual',
                'match'      => 'all',
                'sort_order' => '',
                'rules'      => '',
                'published'  => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ];
    }
}
