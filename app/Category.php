<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name', 'description'];
    protected $with = ['items'];

    public function menu() {
        return $this->belongsTo('App\Menu');
    }
    public function items() {
        return $this->hasMany('App\Item')->orderBy('sort_order');;
    }    
}
