<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function fields()
    {
        return $this->hasMany('App\Field')->orderBy('name');
    }
}
