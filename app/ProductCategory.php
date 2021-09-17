<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{

    public $timestamps = false;
    
    protected $table = 'product_category';

    protected $guarded = [];

    public function product()
    {
    	return $this->hasMany(Product::class, 'id', 'category');
    }
}
