<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price_at_day extends Model
{
   // $table = ''
   protected $fillable = [ 'product_id' , 'price'];
}
