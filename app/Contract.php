<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
  public function group()
  {
      return $this->belongsTo('App\Group');
  }
  public function users()
  {
      return $this->hasMany('App\User')->orderBy('created_at', 'desc');
  }
  public function orders()
  {
      return $this->hasManyThrough('App\Order', 'App\User')->orderBy('created_at', 'desc');
  }
  public function budgets()
  {
      return $this->hasManyThrough('App\Budget', 'App\User')->orderBy('created_at', 'desc');
  }
}
