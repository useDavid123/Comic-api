<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Transformers\CategoryTransformer;
use App\Product;

class Category extends Model
{
    //
    use SoftDeletes;
    protected $fillable = [
        'name' ,
    ];
    public $transformer = CategoryTransformer::class;
    protected $dates = ['deleted_at'];

    public function products(){
        return $this->belongsToMany(Product::class);
    }

}
