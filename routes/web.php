<?php


//////////////// web 
/////// arabic
Route::get('/', 'HomeController@ar_index');
Route::prefix('ar')->group(function () {
    Route::get('/', 'HomeController@ar_index');
    Route::get('/services', 'HomeController@ar_services');
    Route::get('/daily-prices/{id?}', 'HomeController@ar_daily_price');
    Route::get('/about', 'HomeController@ar_about');
    Route::get('/join_us', 'HomeController@ar_join_us');
    Route::get('/contact', 'HomeController@ar_contact');
    Route::post('/join_us', 'HomeController@ar_join_us');
    Route::post('/contact', 'HomeController@ar_contact');

});


Route::get('changeLanguage/{lang}','HomeController@change_language' );
Route::prefix('en')->group(function () {
    Route::get('/', 'HomeController@en_index');
    Route::get('services', 'HomeController@en_services');
    Route::get('daily-prices/{id?}', 'HomeController@en_daily_price');
    Route::get('about', 'HomeController@en_about');
    Route::get('join_us', 'HomeController@en_join_us');
    Route::get('contact', 'HomeController@en_contact');
    Route::post('join_us', 'HomeController@en_join_us');
    Route::post('contact', 'HomeController@en_contact');
});



/////////// control_panell
/////////////// Admin 
Route::prefix('admin')->group(function () {
    /////////// localhost/admin

    Route::namespace('Admin')->group(function () {

        Route::any('/login','PrefController@login')->name('login');
        Route::get('logout' , 'PrefController@logout');
        Route::get('user/{id}/edit', 'UserController@edit');
        Route::middleware(['middleware' => 'manager'])->group(function () {
            Route::get('exportExcel' , 'PriceAtDayController@exportExcel');
            Route::post('upload' , 'PriceAtDayController@import');
            Route::get('/', 'ProductController@index');

            Route::resource('user'    , 'UserController')->middleware('admin');
            Route::get('user/delete/{id}', 'UserController@destroy');

            Route::resource('prefs'    , 'PrefController')->middleware('admin');
            Route::resource('service' , 'ServiceController');
            Route::get('service/delete/{id}', 'ServiceController@destroy');

            Route::resource('category'    , 'CategoryController');
            Route::get('category/delete/{id}', 'CategoryController@destroy');

            Route::resource('products'    , 'ProductController');
            Route::get('products/delete/{id}', 'ProductController@destroy');

            Route::resource('/team', 'TeamController');
            Route::get('team/delete/{id}', 'TeamController@destroy');
            
            Route::resource('/review', 'ReviewController');
            Route::get('review/delete/{id}', 'ReviewController@destroy');

            Route::resource('priceAtDay'    , 'PriceAtDayController');
            Route::get('/copy_day'    , 'PriceAtDayController@copy_day');
            Route::get('/show_prices'    , 'PriceAtDayController@show_prices')->name('show_prices');
            Route::post('/add_price'    , 'PriceAtDayController@add_price');

        });

    });
});




/////////////// mobile
Route::prefix('api')->group(function () {
    
    Route::namespace('Mobile')->group(function () {

       ////// english
        Route::get('en/services', 'MobileController@en_services');
        Route::get('en/daily_price/{id?}', 'MobileController@en_daily_price');
        Route::get('en/about', 'MobileController@en_about');
      ////// arabic
        Route::get('ar/services', 'MobileController@ar_services');
        Route::get('ar/daily_price/{id?}', 'MobileController@ar_daily_price');
        Route::get('ar/about', 'MobileController@ar_about');
        
        Route::post('join_us', 'MobileController@join_us');
        Route::post('contact', 'MobileController@contact');

    });
});
