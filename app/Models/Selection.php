<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Selection extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    protected $guarded=[];

    public $translatedAttributes = ['name'];

    public function item() {
        return $this->belongsTo('App\Models\Item');
    }
}
