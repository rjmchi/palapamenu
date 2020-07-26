<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $with=['orderItems'];

    public function orderItems() {
        return $this->hasMany('App\OrderItem');
    }
}
