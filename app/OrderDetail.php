<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_detail';

    protected $fillable = [
        'product_id', 'order_id', 'price', 'price_agent', 'qty', 'total_price'
    ];

    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
