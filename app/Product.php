<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [	'ar_title' ,	'en_title' ,	'company_name' ,	'category_id' ];	
    public function category()
    {
        return $this->belongsTo('App\Category')->where('categories.deleted_at','=',null);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    function price()    ////// for web 
    {
        return $this->hasOne('App\Price_at_day')->where('day' , date("Y-m-d") );
    }
    function priceProduct()   //// for admin panel 
    {
        return $this->hasOne('App\Price_at_day');
    }
    function priceYesterDaye($count)
    {
        return $this->hasOne('App\Price_at_day')->where('day' , date("Y-m-d", strtotime($count." days")) );
        // date('Y/m/d',strtotime("-1 days")))
    }
}
