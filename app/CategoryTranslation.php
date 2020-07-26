<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
   protected $fillable = ['name', 'description'];
   public $timestamps = false;
}
