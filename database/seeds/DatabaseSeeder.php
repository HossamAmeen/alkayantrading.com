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
        factory('App\Day',1)->create();

       /* factory('App\Service',6)->create();
          factory('App\Product',10)->create();*/
       
        
        
       
    }
}
