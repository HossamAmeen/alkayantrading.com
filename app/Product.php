<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [	'ar_title' ,	'en_title' ,	'company_name' ,	'category_id' ];	
}
