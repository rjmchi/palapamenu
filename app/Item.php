<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Item extends Model implements TranslatableContract
{
    use Translatable;
    protected $guarded = [];

    public $translatedAttributes = ['name', 'description'];

    protected $with=['options', 'choices'];

    public function category() {
        return $this->belongsTo('App\Category');
    }
    public function options() {
        return $this->hasMany('App\Option')->orderBy('sort_order');;
    }
    public function choices() {
        return $this->hasMany('App\Choice')->orderBy('sort_order');;
    }
    public function selections() {
        return $this->hasMany('App\Selection');
    }    
}

