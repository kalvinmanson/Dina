<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }
    public function orders()
    {
        return $this->hasMany('App\Order')->orderBy('created_at', 'desc');
    }
    public function budgets()
    {
        return $this->hasMany('App\Budget')->orderBy('created_at', 'desc');
    }
    public function group()
    {
        return $this->belongsTo('App\Group');
    }
    public function contract()
    {
        return $this->belongsTo('App\Contract');
    }
}
