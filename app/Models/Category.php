<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Category extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $guarded = [];
    public $translatedAttributes = ['name', 'description'];
    protected $with = ['items'];

    public function menu() {
        return $this->belongsTo('App\Models\Menu');
    }

    public function items() {
        return $this->hasMany('App\Models\Item')->orderBy('sort_order');;
    }
}
