<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       factory('App\User',1)->create();
       factory('App\Pref',1)->create();
        // factory('App\Category',5)->create();
        // factory('App\Service',10)->create();
      
       /* factory('App\Service',6)->create();*/
         $this->addCategory();
         $this->addProduct();
         factory('App\Price_at_day',8)->create();
           
        // factory('App\Product',10)->create();       
    }
    function addCategory()
    {
        App\Category::create([
            'ar_title'=>'اسمنت',
            'en_title'=>'asment',
        ]);
        App\Category::create([
          'ar_title'=>'طوب',
          'en_title'=>'toob',
      ]);
      App\Category::create([
          'ar_title'=>'حديد',
          'en_title'=>'hadeed',
      ]);
      App\Category::create([
          'ar_title'=>'زلط',
          'en_title'=>'zald',
      ]);
    }

    function addProduct()
    {
        App\Product::create([
            'ar_title'=>'اسمنت اسيوط',
            'en_title'=>'asment assuit',
            'category_id' =>1
        ]);
        App\Product::create([
            'ar_title'=>'اسمنت المنيا',
            'en_title'=>'asment minia',
            'category_id' =>1
        ]);

        App\Product::create([
            'ar_title'=>'طوب العرب',
            'en_title'=>'toob arab',
            'category_id' =>2
        ]);
        App\Product::create([
            'ar_title'=>'طوب الاساس',
            'en_title'=>'asment basic',
            'category_id' =>2
        ]);

        App\Product::create([
            'ar_title'=>'حديد الممتاز',
            'en_title'=>'mmotaz hadeed',
            'category_id' =>3
        ]);
        App\Product::create([
            'ar_title'=>'حديد المصرين',
            'en_title'=>'hadeed egyption',
            'category_id' =>3
        ]);

        App\Product::create([
            'ar_title'=>'زلط الاسيوطي',
            'en_title'=>'assuit zalad',
            'category_id' =>4
        ]);
        App\Product::create([
            'ar_title'=>'زلط المحلي',
            'en_title'=>'local zald',
            'category_id' =>4
        ]);
        
    }
}
