<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 'review', 'img'
    ];
}
