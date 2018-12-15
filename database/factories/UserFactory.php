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
        'name' => 'admin',
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$mXwEFI/nQub9PmCejn59zuozRujElm4bu5D01y.wXpciRnKjHRWNm', // secret
        'remember_token' => str_random(10),
        'role' => 1 ,
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
        'ar_title' => 'اسمنت اسيوط' ,
        'en_title' => $faker->name,      
        'company_name' => "اسمنت" . "_company",
        'user_id'=>$faker->randomElement($users),
        'category_id'=>$faker->randomElement($categories),
    ];
});
$factory->define(App\Pref::class , function (Faker $faker){
   

    return[
        'arAddress'     =>'arAddress',
        'enAddress'     =>'enAddress',
        'enDescription' =>'enDescription',
        'arDescription' =>'arDescription',
        'phone'         =>'01079979798',
        'arMainAddress' =>'arMainAddress',
        'enMainAddress' =>'enMainAddress',
        'enMainAddress' =>'enMainAddress',
        'mainEmail'     =>'admin@admin.com',
        'facebook'      =>'https://www.facebook.com/',
        'twitter'       =>'https://www.twitter.com/',
        'instgram'      =>'https://www.instgram.com/',
        'linkedin'      =>'https://www.linkedin.com/',

    ];
});
$factory->define(App\Day::class , function (Faker $faker){


    return[

       'day' => date("Y-m-d") ,
    ];
});
