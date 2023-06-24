<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Item extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    protected $guarded = [];

    public $translatedAttributes = ['name', 'description'];

    protected $with=['options', 'choices'];

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }
    public function options() {
        return $this->hasMany('App\Models\Option')->orderBy('sort_order');;
    }
    public function choices() {
        return $this->hasMany('App\Models\Choice')->orderBy('sort_order');;
    }
    public function selections() {
        return $this->hasMany('App\Models\Selection');
    }
}
