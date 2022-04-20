<?php

namespace App\Transformers\Blog;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            'id' => $category->id,
            'name' => $category->name,
//            'slug' => $category->slug,
            'description' => $category->description,
            'icon' => $category->icon,
            'is_featured' => $category->is_featured,
            'is_default' => $category->is_default,
            'created_at' => $category->created_at->toDateTimeString(),
            'updated_at' => $category->updated_at->toDateTimeString(),
        ];
    }
}
