<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Service extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'ar_title', 'en_title', 'category_id' , 'img'
    ];
}
