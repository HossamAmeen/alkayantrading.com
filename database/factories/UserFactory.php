<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
     	 	 	 	 
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'role' => rand(0,1) ,
    ];
});
$factory->define(App\Service::class, function (Faker $faker){
    $categories = App\Category::pluck('id')->toArray();
    $users = App\User::pluck('id')->toArray();
    return 
    [
        'ar_title'=>'تست',
        'en_title'=>$faker->name,
        'user_id'=>$faker->randomElement($users),
        'category_id'=> $faker->randomElement($categories),

        
    ];
});

$factory->define(App\Product::class, function (Faker $faker) {
    
        //    $type = ['steel' , 'cement' , 'Concrete station', 'tracks' , 'wood' , 'Bricks'];
        $categories = App\Category::pluck('id')->toArray();
        $users = App\User::pluck('id')->toArray();  
    return [
        'ar_title' => 'تست',
        'en_title' => $faker->name,      
        'company_name' => $faker->name . "_company",
        'user_id'=>$faker->randomElement($users),
        'category_id'=>$faker->randomElement($categories),
    ];
});

$factory->define(App\Pref::class , function (Faker $faker){
  
    $users = App\User::pluck('id')->toArray();  
    return[
        'phone' => $faker->randomDigitNotNull ,
        'ar_title' => 'تست',
        'en_title' => $faker->name,
        'en_description' => $faker->name,
        'ar_description' => $faker->name,
        'address' => $faker->name,
        'user_id'=>$faker->randomElement($users),
    ];
});
$factory->define(App\Category::class , function (Faker $faker){
   
    $users = App\User::pluck('id')->toArray();  
    return[
        
        'ar_title' => 'تست',
        'en_title' => $faker->name,
       
        'user_id'=>$faker->randomElement($users),
    ];
});
