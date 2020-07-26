<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Menu extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name'];

    protected $with=['categories'];
    public function categories() {
        return $this->hasMany('App\Category')->orderBy('sort_order');
    }    
}
