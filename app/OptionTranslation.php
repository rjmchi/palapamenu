<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OptionTranslation extends Model
{
   protected $fillable = ['name'];
   public $timestamps = false;
}