<?php

namespace App;
use App\Category;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\ProductTransformer;

class Product extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'name' ,
        'description',
        'image',
        'price',

    ];

    protected $dates = ['deleted_at'];
    public $transformer = ProductTransformer::class;

    public function categories(){
        return $this->belongsToMany(Category::class);
    }
}
