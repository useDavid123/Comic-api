<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Product;

class ProductTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */


    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            //
            'id' => (int)$product->id,
            'name' => (string)$product->name,
            'description' => (string)$product->description,
            'price' => (int)$product->price,
            // 'status' => (string)$product->status,
            'image' => (string)$product->image,
   'created_at' => (string)$product->created_at,
            'updated_at' => (string)$product->updated_at,
            'deleted_at' => isset($product->deleted_at) ? (string) $product->deleted_at : null,
        ];
    }
}
