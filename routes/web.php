<?php


//////////////// web 

/////// arabic
Route::get('/', 'HomeController@ar_index');

Route::prefix('ar')->group(function () {
    Route::get('/', 'HomeController@ar_index');
    Route::get('/services', 'HomeController@ar_services');
    Route::get('/daily_price', 'HomeController@ar_daily_price');
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
    Route::get('daily_price', 'HomeController@en_daily_price');
    Route::get('about', 'HomeController@en_about');
    Route::get('join_us', 'HomeController@en_join_us');
    Route::get('contact', 'HomeController@en_contact');
    Route::post('join_us', 'HomeController@en_join_us');
    Route::post('contact', 'HomeController@en_contact');
});



/////////// control_panel

////////// asd@asd.asd asd
/////////////// Admin 
Route::prefix('admin')->group(function () { 
    /////////// localhost:8000/admin
    
    Route::namespace('Admin')->group(function () {
      
        Route::any('/login','PrefController@login')->name('login');
        Route::middleware(['middleware' => 'manager'])->group(function () {
            Route::get('/', 'ProductController@index');
            Route::resource('user'    , 'UserController')->middleware('admin');
            Route::resource('prefs'    , 'PrefController')->middleware('admin');
            Route::resource('service' , 'ServiceController');
            Route::resource('category'    , 'CategoryController');
            Route::resource('products'    , 'ProductController');
            Route::resource('priceAtDay'    , 'PriceAtDayController');
            Route::get('/copy_day'    , 'PriceAtDayController@copy_day');
            Route::get('/show_prices'    , 'PriceAtDayController@show_prices')->name('show_prices');
            Route::post('/add_price/{day_id}'    , 'PriceAtDayController@add_price');
        });
        
    });
});
//////////return \Response::json($arr);	
/////////////// mobile


Route::prefix('api')->group(function () {
    
    Route::namespace('Mobile')->group(function () {
        Route::get('test', function () {
            return view('test');
        });
        Route::post('test', function () {
            return "test";
        });
        Route::get('/', 'MobileController@services');
        Route::get('services', 'MobileController@services');
        Route::get('daily_price', 'MobileController@en_daily_price');
        Route::get('about', 'MobileController@about');
        Route::post('join_us', 'MobileController@join_us');
        Route::post('contact', 'MobileController@contact');

    });
});
