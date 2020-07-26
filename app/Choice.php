<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Choice extends Model implements TranslatableContract
{
    use Translatable;
    public $translatedAttributes = ['name'];
}
