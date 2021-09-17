<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $table = 'orders';

    protected $guarded = [];
    
    public $timestamps = false;


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function orderDetail(){
        return $this->hasMany(OrderDetail::class);
    }

}
