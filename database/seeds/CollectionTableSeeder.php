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
                'name'       => 'Apple',
                'slug'       => 'apple',
                'type'       => 'condition',
                'match'      => 'all',
                'sort_order' => 'name-asc',
                'rules'      => '[[{"column":"vendor"},{"relation":"is_equal_to"},{"condition":"Apple"}]]',
                'published'  => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ], [
                'name'       => 'Nike',
                'slug'       => 'nike',
                'type'       => 'condition',
                'match'      => 'all',
                'sort_order' => 'name-asc',
                'rules'      => '[[{"column":"vendor"},{"relation":"is_equal_to"},{"condition":"Nike"}]]',
                'published'  => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ],
        ];
    }
}
