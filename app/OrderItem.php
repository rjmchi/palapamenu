<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $with=['selections'];

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
    public function selections() {
        return $this->belongsToMany('App\Selection', 'order_item_selection', 'order_item_id', 'selection_id');
    }   
}
