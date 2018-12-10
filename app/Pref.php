<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Pref extends Model
{
   
    protected $fillable = [
        'arAddress', 'enAddress', 'enDescription' , 'arDescription' , 'phone'
        , 'arMainAddress' ,'enMainAddress' ,'enMainAddress',
        'mainEmail' , 'facebook' , 'twitter' , 'instgram' ,'linkedin'
    ];
    protected $dates = ['deleted_at'];
}
