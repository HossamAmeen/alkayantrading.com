<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'ar_title', 'en_title', 'category_id' , 'img'
    ];
    public function category()
    {
        return $this->belongsTo('App\Category')->where('categories.deleted_at','=',null);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
