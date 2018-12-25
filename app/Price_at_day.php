<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_at_day extends Model
{
   // $table = ''
   protected $fillable = [ 'day_id','product_id' , 'price'];
}
