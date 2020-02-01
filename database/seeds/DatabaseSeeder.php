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
        factory('App\Category',5)->create();
        // factory('App\Service',10)->create();
        // factory('App\Price_at_day',9)->create();
       /* factory('App\Service',6)->create();*/
          factory('App\Product',10)->create();       
        
        
       
    }
}
