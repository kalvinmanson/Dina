<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public function pages()
    {
        return $this->hasMany('App\Page')->orderBy('weight');
    }
    public function fields()
    {
        return $this->hasMany('App\Field')->orderBy('name');
    }
}
