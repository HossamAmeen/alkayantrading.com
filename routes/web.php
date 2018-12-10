<?php


//////////////// web 


Route::get('change_language','HomeController@change_language' );

Route::get('/en','HomeController@en_index' );
Route::get('en/services','HomeController@en_services');
Route::get('en/daily_price','HomeController@en_daily_price');
Route::get('en/about','HomeController@en_about');
Route::get('en/join_us','HomeController@en_join_us');
Route::get('en/contact','HomeController@en_contact');
Route::post('en/join_us','HomeController@en_join_us');
Route::post('en/contact','HomeController@en_contact');


/////// arabic
Route::get('/','HomeController@ar_index' );
Route::get('/ar','HomeController@ar_index' );
Route::get('/ar/services','HomeController@ar_services');
Route::get('/ar/daily_price','HomeController@ar_daily_price');
Route::get('/ar/_about','HomeController@ar_about');
Route::get('/ar/join_us','HomeController@ar_join_us');
Route::get('/ar/contact','HomeController@ar_contact');
Route::post('/ar/join_us','HomeController@ar_join_us');
Route::post('/ar/contact','HomeController@ar_contact');

///https://code.jquery.com/jquery-3.3.1.min.js
/////////// control_panel





////////// asd@asd.asd asd
/////////////// Admin 
Route::prefix('admin')->group(function () { 
    /////////// localhost:8000/admin
    
    Route::namespace('Admin')->group(function () {
      
        Route::any('/login','PrefController@login')->name('login');
        Route::middleware(['middleware' => 'manager'])->group(function () {
            Route::resource('user'    , 'UserController')->middleware('admin');
            Route::resource('pref'    , 'PrefController')->middleware('admin');
            Route::resource('service' , 'ServiceController');
            Route::resource('category'    , 'CategoryController');
            Route::resource('product'    , 'ProductController');
            Route::resource('priceAtDay'    , 'PriceAtDayController');
            Route::get('/copy_day'    , 'PriceAtDayController@copy_day');
            Route::get('/show_prices'    , 'PriceAtDayController@show_prices');
        });
        
    });
});
//////////return \Response::json($arr);	
/////////////// mobile
Route::prefix('API')->group(function () { 
    
    Route::namespace('Mobile')->group(function () {

        Route::get('en_index','MobileController@en_index' );
    });
});
