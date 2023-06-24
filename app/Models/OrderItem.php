<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $with=['selections'];

    public function order() {
        return $this->belongsTo('App\Models\Order');
    }
    public function item(){
        return $this->belongsTo('App\Models\Item');
    }
    public function choice(){
        return $this->belongsTo('App\Models\Choice');
    }
    public function option(){
        return $this->belongsTo('App\Models\Option');
    }
    public function selections() {
        return $this->belongsToMany('App\Models\Selection', 'order_item_selection', 'order_item_id', 'selection_id');
    }
}
