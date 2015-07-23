<?php

namespace Quincalla\Entities;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @var string Table name
     */
    protected $table = 'tags';

    /**
     * @var array Define mass assignable fields
     */
    protected $fillable = ['name'];

    /**
     * Get all products that belongs to a collection
     *
     * return Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany('Quincalla\Entities\Product')
            ->withTimestamps();
    }

    /**
     * Sync product tags.
     *
     * @param Quincalla\Entities\Product
     * @param array $tags List of tags form input
     *
     * @return Quincalla\Entities\Product
     */
    public function syncProductTags($product, $tags)
    {
        $tagIds = [];

        if ($tags) {
            $tagIds = $this->idsFromOldAndNewTags($tags);
        }

        return $product->tags()->sync($tagIds);
    }

    /**
     * Return a list of ids from old and newly created tags
     *
     * @param array $tags 
     *
     * @return array
     */
    private function idsFromOldAndNewTags($tags)
    {
        $tagIds = [];

        foreach ($tags as $key => $tag) {
            if (!is_numeric($tag)) {
                $newTag = $this->firstOrCreate(['name' => $tag]);
                $tagIds[] = $newTag->id;
            } else {
                $tagIds[] = (int) $tag;
            }
        }

        return $tagIds;
    }
}
