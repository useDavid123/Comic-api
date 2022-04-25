<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Category;

class CategoryTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */


    /**
     * List of resources possible to include
     *
     * @var array
     */


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Category $category)
    {
        return [
            //
            'id' => (int)$category->id,
            'name' => (string)$category->name,
            'created_at' => (string)$category->created_at,
            'updated_at' => (string)$category->updated_at,
            'deleted_at' => isset($product->deleted_at) ? (string) $product->deleted_at : null,
        ];
    }
}
