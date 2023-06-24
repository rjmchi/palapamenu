<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Menu extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    protected $guarded = [];
    public $translatedAttributes = ['name'];

    protected $with=['categories'];
    public function categories() {
        return $this->hasMany('App\Models\Category')->orderBy('sort_order');
    }
}
