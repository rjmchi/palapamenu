<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function order() {
        return $this->belongsTo('App\Order');
    }
    public function item(){
        return $this->belongsTo('App\Item');
    }
    public function choice(){
        return $this->belongsTo('App\Choice');
    } 
    public function option(){
        return $this->belongsTo('App\Option');
    }     
}
