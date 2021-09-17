<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    
    protected $table = 'product';

    protected $guarded = [];
    public $timestamps = false;

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'category', 'id');
    }

    public function orderDetail()
    {
        return $this->hasMany(OrderDetail::class);
    }


}
