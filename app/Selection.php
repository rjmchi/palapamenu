<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Selection extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name'];

    public function item() {
        return $this->belongsTo('App\Item');
    }    
}
