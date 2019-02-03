<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'email', 'password','role','img'
    ];

   protected $hidden = [
    'password','remember_token',
    ];

    public function Categories()
    {
        return $this->hasMany('App\Category');
    }
   
}
