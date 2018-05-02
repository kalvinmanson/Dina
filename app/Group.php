<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  public function products()
  {
      return $this->belongsToMany('App\Product');
  }
  public function contracts()
  {
      return $this->hasMany('App\Contract')->orderBy('created_at', 'desc');
  }
}
