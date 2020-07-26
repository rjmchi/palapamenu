<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemTranslation extends Model
{
   protected $fillable = ['name', 'description'];
   public $timestamps = false;
}
